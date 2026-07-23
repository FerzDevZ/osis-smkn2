<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LostFound extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'type', 'status', 'reporter_id'];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
