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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            // Core content
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt')->nullable();
            $table->longText('content')->nullable();

            // Media (ImageKit URL for cover image)
            $table->string('cover_image')->nullable();

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('keywords')->nullable();

            // Metadata
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('author')->nullable();

            // Publishing
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable()->index();

            // Analytics
            $table->integer('views')->default(0);

            $table->timestamps();

            // Indexes to help SEO queries
            $table->index(['status', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};


