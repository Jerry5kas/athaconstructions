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
        Schema::create('property_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->integer('bhk')->index(); // 1, 2, 3, 4
            $table->float('carpet_area')->nullable();
            $table->float('builtup_area')->nullable();
            $table->float('super_builtup_area')->nullable();
            $table->string('floor_plan_image')->nullable(); // ImageKit URL
            $table->string('floor_plan_image_file_id')->nullable(); // ImageKit file ID
            $table->timestamps();
            
            $table->index(['property_id', 'bhk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_units');
    }
};

