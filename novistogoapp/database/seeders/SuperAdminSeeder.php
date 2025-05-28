<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Change this password!
                'role' => 'superadmin',
                'is_admin' => true, // Keep is_admin consistent
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Regular Admin',
                'password' => Hash::make('password'), // Change this password!
                'role' => 'admin',
                'is_admin' => true, // Keep is_admin consistent
                'email_verified_at' => now(),
            ]
        );
    }
}
