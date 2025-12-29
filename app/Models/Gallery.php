<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title','description','cover_path','album_date'
    ];

    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('display_order')->orderBy('id');
    }
}
