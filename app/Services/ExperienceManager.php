<?php

namespace App\Services;

use App\Models\User;
use App\Models\StudentProfile;

class ExperienceManager
{
    public static function addXp(User $user, int $amount)
    {
        $profile = $user->profile()->firstOrCreate(['user_id' => $user->id]);
        
        $oldLevel = $profile->level;
        $profile->xp += $amount;
        $profile->level = $profile->calculateLevel();
        $profile->save();

        if ($profile->level > $oldLevel) {
            // Potential event for level up
            session()->flash('level_up', "Selamat! Anda naik ke Level {$profile->level}!");
        }
        
        return $profile;
    }
}
