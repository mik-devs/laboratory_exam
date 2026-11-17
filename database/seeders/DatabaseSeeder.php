<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\StudentEmployee;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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

        $deptIT = Department::updateOrCreate(
            ['department_id' => 'IT-101'],
            [
                'college' => 'College of Computer Studies',
                'description' => 'Information Technology Department',
            ]
        );

        $deptEng = Department::updateOrCreate(
            ['department_id' => 'ENG-202'],
            [
                'college' => 'College of Engineering',
                'description' => 'Engineering Department',
            ]
        );

        $mikko = User::updateOrCreate(
            ['email' => 'mikko@example.com'],
            [
                'name' => 'Mikko Momo',
                'password' => Hash::make('password123'),
                'role' => 'student', 
                'status' => 1,
                'email_verified_at' => now(),
            ]
        );

        $mark = User::updateOrCreate(
            ['email' => 'mark@example.com'],
            [
                'name' => 'Mark Zucker Burg',
                'password' => Hash::make('password123'),
                'role' => 'student', 
                'status' => 1,
                'email_verified_at' => now(),
            ]
        );

        $jayson = User::updateOrCreate(
            ['email' => 'jayson@example.com'],
            [
                'name' => 'Jayson Lozada',
                'password' => Hash::make('password123'),
                'role' => 'employee', 
                'status' => 1,
                'email_verified_at' => now(),
            ]
        );

        $mikkoDev = User::updateOrCreate(
            ['email' => 'mikko.dev@example.com'],
            [
                'name' => 'Mikko Momo Dev',
                'password' => Hash::make('password123'),
                'role' => 'employee',
                'status' => 1,
                'email_verified_at' => now(),
            ]
        );

        
        StudentEmployee::updateOrCreate(
            ['user_id' => $mikko->id],
            [
                'student_id' => '2024-0001',
                'program' => 'BS Information Technology',
                'department_id' => $deptIT->id,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $mark->id],
            [
                'student_id' => '2024-0002',
                'program' => 'BS Civil Engineering',
                'department_id' => $deptEng->id,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $jayson->id],
            [
                'student_id' => null, 
                'program' => 'IT Support Specialist',
                'department_id' => $deptIT->id,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $mikkoDev->id],
            [
                'student_id' => null,
                'program' => 'Software Engineer',
                'department_id' => $deptEng->id,
            ]
        );
    }
}