<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update a default admin user for the dashboard
        User::updateOrCreate(
            ['email' => 'admin@athaconstruction.com'],
            [
                'name' => 'Atha Admin',
                // The User model casts `password` as 'hashed', so this plain
                // text value will be automatically hashed when saved.
                'password' => 'Admin@12345',
            ]
        );
    }
}
