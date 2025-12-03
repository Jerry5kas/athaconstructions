<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index(); // Indexed for fast lookups
            $table->string('slug')->unique()->index(); // Unique slug for URLs, indexed
            $table->text('description')->nullable();
            $table->string('media_path')->nullable(); // Single field for all image types (PNG, JPG, GIF, SVG)
            $table->string('media_type')->nullable()->index(); // Type: image, svg, icon (for filtering)
            $table->integer('sort_order')->default(0)->index(); // For ordering
            $table->boolean('is_active')->default(true)->index(); // Indexed for filtering active categories
            $table->timestamps();
            
            // Composite indexes for common query patterns
            $table->index(['is_active', 'sort_order']); // For active categories ordered by sort
            $table->index(['is_active', 'created_at']); // For active categories by date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
