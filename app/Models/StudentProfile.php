<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = ['user_id', 'nisn', 'class', 'grade', 'xp', 'level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate level based on XP
     * Example: Level = floor(sqrt(xp / 100)) + 1
     */
    public function calculateLevel()
    {
        return floor(sqrt($this->xp / 100)) + 1;
    }
}
