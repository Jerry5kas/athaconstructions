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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('page_title')->nullable();
            $table->text('description')->nullable();
            $table->string('pagetype')->nullable();
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->boolean('use_image')->default(true);
            $table->boolean('use_video')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
