<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'meeting_date',
        'agenda',
        'notes',
        'passcode',
        'is_active'
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function attendances()
    {
        return $this->hasMany(MeetingAttendance::class);
    }
}
