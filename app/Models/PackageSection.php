<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PackageSection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name if not provided
        static::creating(function ($section) {
            if (empty($section->slug)) {
                $section->slug = Str::slug($section->name);
            }
        });

        static::updating(function ($section) {
            if ($section->isDirty('name') && empty($section->slug)) {
                $section->slug = Str::slug($section->name);
            }
        });
    }

    /**
     * Get the features for this section.
     */
    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }

    /**
     * Get features for a specific package.
     */
    public function featuresForPackage($packageId)
    {
        return $this->features()->where('package_id', $packageId)->first();
    }

    /**
     * Scope: Get only active sections.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
