<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyLocation extends Model
{
    protected $fillable = [
        'property_id',
        'address',
        'city',
        'locality',
        'landmark',
        'latitude',
        'longitude',
        'pincode',
    ];

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

