<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'primary_button_text',
        'primary_button_link',
        'image_path',
        'video_path',
        'use_image',
        'use_video',
        'is_active',
    ];
}
