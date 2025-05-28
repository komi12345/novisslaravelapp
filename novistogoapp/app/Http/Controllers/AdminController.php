<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post; // Importer le modèle Post
use App\Models\Project; // Importer le modèle Project

class AdminController extends Controller
{
    // Méthode pour afficher le tableau de bord administrateur
    public function dashboard()
    {
        // Récupérer les articles de blog et les projets
        $posts = Post::latest()->paginate(10); // Récupérer les 10 derniers articles, paginés
        $projects = Project::latest()->paginate(10); // Récupérer les 10 derniers projets, paginés
        return view('admin.dashboard', compact('posts', 'projects'));
    }

    // Ajoutez d'autres méthodes pour gérer les utilisateurs, les produits, etc.
    // Exemple : Afficher la liste des utilisateurs
    public function users()
    {
        $users = User::paginate(10); // Paginer les résultats
        return view('admin.users.index', compact('users'));
    }
}