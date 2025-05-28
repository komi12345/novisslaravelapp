<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'image', 'tag', 'published_at', 'summary']; // Ajout des champs image, tag, published_at et summary
    
    protected $casts = [
        'published_at' => 'datetime',
    ];

    //
}
