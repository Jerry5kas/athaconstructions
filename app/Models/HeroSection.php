<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'page_title',
        'description',
        'pagetype',
        'image_path',
        'video_path',
        'use_image',
        'use_video',
        'is_active',
    ];
}
