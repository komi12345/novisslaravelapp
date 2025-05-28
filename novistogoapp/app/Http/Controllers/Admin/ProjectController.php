<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Typically redirects to the main dashboard where projects are listed
        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
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
            $path = $request->file('image')->store('projects', 'public'); // Stocke dans storage/app/public/projects
            $validatedData['image'] = $path;
        }

        // Déterminer l'étiquette à enregistrer
        if ($request->input('tag_select') === 'Autre') {
            $validatedData['tag'] = $request->input('tag_custom');
        } elseif ($request->filled('tag_select') && $request->input('tag_select') !== '') {
            $validatedData['tag'] = $request->input('tag_select');
        }

        // Créer un résumé à partir du contenu si non fourni
        if (!isset($validatedData['summary']) || empty($validatedData['summary'])) {
            $validatedData['summary'] = substr(strip_tags($validatedData['content']), 0, 150) . '...';
        }

        // Définir la date de publication si le projet doit être publié immédiatement
        if ($request->has('publish') && $request->input('publish')) {
            $validatedData['published_at'] = now();
        }

        Project::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Projet créé avec succès!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
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
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validatedData['image'] = $path;
        }

        // Déterminer l'étiquette à enregistrer
        if ($request->input('tag_select') === 'Autre') {
            $validatedData['tag'] = $request->input('tag_custom');
        } elseif ($request->filled('tag_select') && $request->input('tag_select') !== '') {
            $validatedData['tag'] = $request->input('tag_select');
        }

        // Créer un résumé à partir du contenu si non fourni
        if (!isset($validatedData['summary']) || empty($validatedData['summary'])) {
            $validatedData['summary'] = substr(strip_tags($validatedData['content']), 0, 150) . '...';
        }

        // Gérer la publication/dépublication
        if ($request->has('publish') && $request->input('publish') && !$project->published_at) {
            $validatedData['published_at'] = now();
        } elseif ($request->has('unpublish') && $request->input('unpublish') && $project->published_at) {
            $validatedData['published_at'] = null;
        }

        $project->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Projet mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Supprimer l'image associée si elle existe
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Projet supprimé avec succès!');
    }
}