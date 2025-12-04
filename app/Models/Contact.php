<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'plotsize',
        'message',
        'created_at',
        'updated_at',
    ];
}


