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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index(); // Indexed for fast lookups
            $table->string('slug')->unique()->index(); // Unique slug for URLs, indexed
            $table->text('description')->nullable();
            $table->string('image_path')->nullable(); // Image storage path
            $table->integer('sort_order')->default(0)->index(); // For ordering
            $table->boolean('is_active')->default(true)->index(); // Indexed for filtering active services
            $table->timestamps();
            
            // Composite indexes for common query patterns
            $table->index(['is_active', 'sort_order']); // For active services ordered by sort
            $table->index(['is_active', 'created_at']); // For active services by date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
