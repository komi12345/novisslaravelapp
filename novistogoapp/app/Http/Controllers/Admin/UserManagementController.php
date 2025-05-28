<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users_management.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'superadmin'])],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_admin' => in_array($request->role, ['admin', 'superadmin']), // Keep is_admin consistent for now
        ]);

        return redirect()->route('admin.users.management.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) // Route model binding
    {
        // Not typically used for user management in this context, redirect to edit or index
        return redirect()->route('admin.users.management.edit', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) // Route model binding
    {
        return view('admin.users_management.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) // Route model binding
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'superadmin'])],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_admin' => in_array($request->role, ['admin', 'superadmin']), // Keep is_admin consistent
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Prevent a superadmin from demoting the last superadmin or themselves if they are the last one
        if ($user->role === 'superadmin' && $request->role !== 'superadmin') {
            $superAdminCount = User::where('role', 'superadmin')->count();
            if ($superAdminCount <= 1) {
                 // Check if the user being edited is the currently authenticated user
                if (Auth::id() === $user->id) {
                    return redirect()->back()->with('error', 'Vous ne pouvez pas vous rétrograder car vous êtes le dernier super administrateur.');
                }
                // If not the authenticated user but still the last superadmin
                if ($superAdminCount === 1 && $user->role === 'superadmin') {
                     return redirect()->back()->with('error', 'Impossible de rétrograder le dernier super administrateur.');
                }
            }
        }


        $user->update($userData);

        return redirect()->route('admin.users.management.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) // Route model binding
    {
        // Prevent deleting the currently logged-in superadmin or the last superadmin
        if ($user->role === 'superadmin') {
            if (Auth::id() === $user->id) {
                return redirect()->route('admin.users.management.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte super administrateur.');
            }
            $superAdminCount = User::where('role', 'superadmin')->count();
            if ($superAdminCount <= 1) {
                return redirect()->route('admin.users.management.index')->with('error', 'Impossible de supprimer le dernier super administrateur.');
            }
        }

        $user->delete();
        return redirect()->route('admin.users.management.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
