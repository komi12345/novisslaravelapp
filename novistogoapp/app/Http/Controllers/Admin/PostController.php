<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Ajout pour la gestion du stockage

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Typically redirects to the main dashboard where posts are listed
        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag_select' => 'nullable|string',
            'tag_custom' => 'nullable|string|required_if:tag_select,Autre|max:50', // Requis si 'Autre' est sélectionné
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public'); // Stocke dans storage/app/public/posts
            $validatedData['image'] = $path;
        }

        // Déterminer l'étiquette à enregistrer
        if ($request->input('tag_select') === 'Autre') {
            $validatedData['tag'] = $request->input('tag_custom');
        } elseif ($request->filled('tag_select') && $request->input('tag_select') !== '') {
            $validatedData['tag'] = $request->input('tag_select');
        } else {
            $validatedData['tag'] = null; // Aucune étiquette sélectionnée ou fournie
        }
        // Supprimer les champs temporaires du tableau validé
        unset($validatedData['tag_select'], $validatedData['tag_custom']);
        
        // Définir la date de publication au moment de la création
        $validatedData['published_at'] = now();

        Post::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Not typically used in admin CRUD, maybe redirect or show details
        return view('admin.posts.show', compact('post')); // Assuming a show view exists or will be created
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag_select' => 'nullable|string',
            'tag_custom' => 'nullable|string|required_if:tag_select,Autre|max:50',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Stocker la nouvelle image
            $path = $request->file('image')->store('posts', 'public');
            $validatedData['image'] = $path;
        } elseif ($request->filled('remove_image') && $post->image) {
            // Option pour supprimer l'image sans en ajouter une nouvelle (nécessite ajout case à cocher dans le formulaire)
            Storage::disk('public')->delete($post->image);
            $validatedData['image'] = null;
        }

        // Déterminer l'étiquette à enregistrer pour la mise à jour
        if ($request->has('tag_select')) { // Vérifie si tag_select est présent dans la requête
            if ($request->input('tag_select') === 'Autre') {
                $validatedData['tag'] = $request->input('tag_custom');
            } elseif ($request->input('tag_select') !== '') { // Si une étiquette prédéfinie est choisie
                $validatedData['tag'] = $request->input('tag_select');
            } else { // Si '-- Choisir --' (valeur vide) est sélectionné
                $validatedData['tag'] = null;
            }
        }
        // Si tag_select n'est pas dans la requête, $validatedData ne contiendra pas 'tag', et le tag existant ne sera pas modifié.

        // Supprimer les champs temporaires qui ne sont pas des colonnes de la table
        unset($validatedData['tag_select'], $validatedData['tag_custom']);
        
        // Mettre à jour la date de publication si elle n'existe pas déjà
        if (!$post->published_at) {
            $validatedData['published_at'] = now();
        }

        $post->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Supprimer l'image associée si elle existe
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Article supprimé avec succès.');
    }
}
