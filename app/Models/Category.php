<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'media_path',
        'media_type',
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
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get the media URL.
     */
    public function getMediaUrlAttribute()
    {
        if (!$this->media_path) {
            return null;
        }

        return Storage::disk('public')->url($this->media_path);
    }

    /**
     * Scope: Get only active categories.
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

    /**
     * Scope: Filter by media type.
     */
    public function scopeByMediaType($query, $type)
    {
        return $query->where('media_type', $type);
    }

    /**
     * Get categories optimized for dropdowns/selects.
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->select('id', 'name', 'slug')
            ->get()
            ->pluck('name', 'id');
    }
}
