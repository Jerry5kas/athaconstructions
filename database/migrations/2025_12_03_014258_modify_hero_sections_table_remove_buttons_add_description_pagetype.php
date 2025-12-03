<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            // Remove old columns if they exist
            $columnsToDrop = [];
            if (Schema::hasColumn('hero_sections', 'primary_button_text')) {
                $columnsToDrop[] = 'primary_button_text';
            }
            if (Schema::hasColumn('hero_sections', 'primary_button_link')) {
                $columnsToDrop[] = 'primary_button_link';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
        
        // Rename subtitle to page_title (using raw SQL as Laravel doesn't have renameColumn)
        if (Schema::hasColumn('hero_sections', 'subtitle')) {
            DB::statement('ALTER TABLE hero_sections CHANGE subtitle page_title VARCHAR(255) NULL');
        }
        
        Schema::table('hero_sections', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('hero_sections', 'description')) {
                $table->text('description')->nullable()->after('page_title');
            }
            if (!Schema::hasColumn('hero_sections', 'pagetype')) {
                $table->string('pagetype')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['description', 'pagetype']);
        });
        
        // Rename page_title back to subtitle
        if (Schema::hasColumn('hero_sections', 'page_title')) {
            DB::statement('ALTER TABLE hero_sections CHANGE page_title subtitle VARCHAR(255) NULL');
        }
        
        Schema::table('hero_sections', function (Blueprint $table) {
            // Add back old columns
            $table->string('primary_button_text')->nullable()->after('subtitle');
            $table->string('primary_button_link')->nullable()->after('primary_button_text');
        });
    }
};
