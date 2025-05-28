<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'sender_name',
        'sender_email',
        'sender_phone',
        'sender_project',
        'sender_subject',
        'sender_message',
    ];
}
