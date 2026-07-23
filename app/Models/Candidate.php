<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name', 'photo_path', 'vision', 'mission', 'order'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
