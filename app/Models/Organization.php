<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name','slug','description','image_path','instagram_url','contact','display_order','programs'
    ];

    protected $casts = [
        'programs' => 'array',
    ];
}


