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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug')->unique()->index();
            $table->enum('project_type', ['apartment', 'villa', 'plot', 'commercial'])->index();
            $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming')->index();
            $table->string('rera_number')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->date('launch_date')->nullable();
            $table->date('possession_date')->nullable();
            $table->string('total_land_area')->nullable(); // e.g., "3 Acres 20 Guntas"
            $table->integer('total_units')->nullable();
            $table->integer('floors')->nullable();
            $table->string('featured_image')->nullable(); // ImageKit URL
            $table->string('featured_image_file_id')->nullable(); // ImageKit file ID
            $table->string('brochure_url')->nullable(); // PDF link
            $table->string('video_url')->nullable(); // Walkthrough video
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            
            // Composite indexes for common queries
            $table->index(['status', 'project_type']);
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

