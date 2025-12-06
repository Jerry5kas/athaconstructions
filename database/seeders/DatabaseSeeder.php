<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default admin user for the dashboard
        $this->call(AdminUserSeeder::class);
        
        // Seed packages, sections, and features
        $this->call(PackageSeeder::class);

        // Seed properties and related data
        $this->call(PropertySeeder::class);

        // Seed testimonials
        $this->call(TestimonialSeeder::class);
    }
}
