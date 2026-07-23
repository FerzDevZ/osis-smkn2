<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenfessMessage extends Model
{
    protected $fillable = ['content', 'is_approved', 'sender_id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
