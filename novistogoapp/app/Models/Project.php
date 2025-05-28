<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'image', 'tag', 'published_at', 'summary'];
    
    protected $casts = [
        'published_at' => 'datetime',
    ];
}