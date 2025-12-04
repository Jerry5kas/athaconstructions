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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            // SEO
            $table->string('slug')->unique();

            // Testimonial Content
            $table->string('title');
            $table->text('review_text');
            $table->unsignedTinyInteger('rating')->nullable();

            // Author / Client Info
            $table->string('client_name');
            $table->string('client_role')->nullable();
            $table->string('client_company')->nullable();
            $table->string('client_avatar')->nullable();

            // Project Info
            $table->string('project_name')->nullable();
            $table->string('project_location')->nullable();
            $table->string('project_type')->nullable();

            // Flags
            $table->boolean('featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('published');

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};


