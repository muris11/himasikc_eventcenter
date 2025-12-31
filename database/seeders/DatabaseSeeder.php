<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create super admin user
        User::firstOrCreate(
            ['email' => 'admin@hima.com'],
            [
                'name' => 'Admin HIMA SIKC',
                'password' => 'password', // Will be auto-hashed by User model cast
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            EventCategorySeeder::class,
            PostCategorySeeder::class,
            EventSeeder::class,
            PostSeeder::class,
        ]);
    }
}
