<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin@12345'),
                'role' => 'admin',
                'status' => 1,
                'email_verified_at' => now(),
            ]
        );

        // 2. Apat (4) na User Accounts
        $users = [
            [
                'name' => 'Mikko Momo',
                'email' => 'mikko@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 1,
            ],
            [
                'name' => 'Mark Zucker Burg',
                'email' => 'mark@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 1,
            ],
            [
                'name' => 'Jayson Lozada',
                'email' => 'jayson@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 1,
            ],
            [
                'name' => 'Mikko Momo Dev',
                'email' => 'mikko.dev@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 1,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, ['email_verified_at' => now()])
            );
        }
    }
}