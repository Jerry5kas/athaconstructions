<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialMedia extends Model
{
    protected $fillable = [
        'testimonial_id',
        'media_type',
        'media_url',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}


