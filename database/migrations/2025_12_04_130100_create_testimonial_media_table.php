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
        Schema::create('testimonial_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonial_id')
                ->constrained('testimonials')
                ->onDelete('cascade');

            $table->enum('media_type', ['image', 'video']);
            $table->string('media_url', 500);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial_media');
    }
};


