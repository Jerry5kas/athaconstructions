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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'image_file_id')) {
                $table->string('image_file_id')->nullable()->after('image_path');
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'media_file_id')) {
                $table->string('media_file_id')->nullable()->after('media_path');
            }
        });

        Schema::table('hero_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('hero_sections', 'image_file_id')) {
                $table->string('image_file_id')->nullable()->after('image_path');
            }
            if (!Schema::hasColumn('hero_sections', 'video_file_id')) {
                $table->string('video_file_id')->nullable()->after('video_path');
            }
        });

        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'cover_image_file_id')) {
                $table->string('cover_image_file_id')->nullable()->after('cover_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'image_file_id')) {
                $table->dropColumn('image_file_id');
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'media_file_id')) {
                $table->dropColumn('media_file_id');
            }
        });

        Schema::table('hero_sections', function (Blueprint $table) {
            if (Schema::hasColumn('hero_sections', 'image_file_id')) {
                $table->dropColumn('image_file_id');
            }
            if (Schema::hasColumn('hero_sections', 'video_file_id')) {
                $table->dropColumn('video_file_id');
            }
        });

        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'cover_image_file_id')) {
                $table->dropColumn('cover_image_file_id');
            }
        });
    }
};


