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
        // Create Admin Role
        $adminRole = \App\Models\Role::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions_cache' => ['*'], // Full access
        ]);

        // Create Default Admin User
        \App\Models\User::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@hotel.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);
    }
}
