<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title','slug','description','start_at','end_at','location','cover_path','is_published', 'progress', 'is_featured', 'category'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_published' => 'boolean',
        'progress' => 'integer',
        'is_featured' => 'boolean',
    ];
}
