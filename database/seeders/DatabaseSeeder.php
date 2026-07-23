<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@thinkclear.co.in'],
            [
                'name' => 'Dr. Arun R. Mishra (Admin)',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'current_day' => 60,
                'phase' => 3,
            ]
        );

        // Seed Test Student User
        User::updateOrCreate(
            ['email' => 'arun@example.com'],
            [
                'name' => 'Arun Mishra',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'current_day' => 7,
                'phase' => 1,
            ]
        );

        $this->call([
            CaseSeeder::class,
        ]);
    }
}
