<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Affiche la liste des articles de blog publiés
     */
    public function index()
    {
        // Récupérer uniquement les articles publiés (avec published_at non null)
        $posts = Post::whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->get();

        return view('blog.index', compact('posts'));
    }

    /**
     * Affiche un article spécifique
     */
    public function show(Post $post)
    {
        // Vérifier que l'article est publié
        if (!$post->published_at) {
            abort(404);
        }

        return view('blog.show', compact('post'));
    }
}