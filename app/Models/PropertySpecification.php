<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertySpecification extends Model
{
    protected $fillable = [
        'property_id',
        'section',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Scopes
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('section');
    }
}

