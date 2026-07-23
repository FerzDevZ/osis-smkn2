<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_name',
        'media_path',
        'media_type',
        'caption',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
