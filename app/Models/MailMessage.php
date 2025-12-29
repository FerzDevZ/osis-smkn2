<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailMessage extends Model
{
    protected $fillable = [
        'is_anonymous','student_name','class_name','contact','category','message','status','is_public'
    ];
}
