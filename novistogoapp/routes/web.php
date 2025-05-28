<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PostController; // Importer le contrôleur des posts
use App\Http\Controllers\Admin\ProjectController; // Importer le contrôleur des projets
use App\Http\Controllers\BlogController; // Importer le contrôleur du blog public
use App\Http\Controllers\Admin\UserManagementController; // Importer le contrôleur de gestion des utilisateurs

use App\Models\Post; // Assurez-vous que le modèle Post est importé
use App\Models\Project; // Importer le modèle Project

Route::get('/', function () {
    $posts = Post::whereNotNull('published_at') // Vérifie si l'article est publié
                 ->latest('published_at') // Ou 'created_at' selon votre champ
                 ->get(); // Récupère tous les articles publiés
    
    $projects = Project::whereNotNull('published_at') // Vérifie si le projet est publié
                     ->latest('published_at')
                     ->get(); // Récupère tous les projets publiés
                     
    return view('welcome', ['posts' => $posts, 'projects' => $projects]);
});

// Routes pour l'administration
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');

    // Routes pour la gestion des articles de blog (CRUD)
    Route::resource('posts', PostController::class)->names('admin.posts');
    
    // Routes pour la gestion des projets (CRUD)
    Route::resource('projects', ProjectController::class)->names('admin.projects');

    // Ajoutez d'autres routes admin ici
});

// Routes pour la gestion des utilisateurs (SuperAdmin uniquement)
Route::middleware(['auth', 'admin', 'superadmin'])->prefix('admin/user-management')->name('admin.users.management.')->group(function () {
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
    Route::post('/', [UserManagementController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
});

// Routes pour le blog public
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index'); // Route pour afficher la liste des articles
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show'); // Route pour afficher un article spécifique

// Route pour le formulaire de contact
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
