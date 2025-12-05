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
        Schema::create('property_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['interior', 'exterior', 'amenities', 'floorplan', 'masterplan'])->index();
            $table->string('image_url'); // ImageKit URL
            $table->string('image_file_id')->nullable(); // ImageKit file ID
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
            
            $table->index(['property_id', 'type']);
            $table->index(['property_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_gallery');
    }
};

