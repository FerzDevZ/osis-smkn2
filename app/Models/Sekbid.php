<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekbid extends Model
{
    protected $fillable = [
        'name','slug','description','image_path','display_order','instagram_url','programs'
    ];

    protected $casts = [
        'programs' => 'array',
    ];
}
