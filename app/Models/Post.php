<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','excerpt','body','cover_path','status','type','published_at','author_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
