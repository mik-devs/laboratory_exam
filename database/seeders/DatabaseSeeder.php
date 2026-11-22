<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\StudentEmployee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('Admin@12345'),
                'user_type' => 'admin',
                'status' => 1,
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
            ['username' => 'mikko'],
            [
                'email' => 'mikko@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'student',
                'status' => 1,
            ]
        );

        $mark = User::updateOrCreate(
            ['username' => 'mark'],
            [
                'email' => 'mark@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'student',
                'status' => 1,
            ]
        );

        $jayson = User::updateOrCreate(
            ['username' => 'jayson'],
            [
                'email' => 'jayson@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'employee',
                'status' => 1,
            ]
        );

        $mikkoDev = User::updateOrCreate(
            ['username' => 'mikko.dev'],
            [
                'email' => 'mikko.dev@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'employee',
                'status' => 1,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $mikko->user_id],
            [
                'student_id' => '2024-0001',
                'name' => 'Mikko',
                'lastname' => 'Momo',
                'middlename' => 'C',
                'department_id' => $deptIT->id,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $mark->user_id],
            [
                'student_id' => '2024-0002',
                'name' => 'Mark',
                'lastname' => 'Zuckerberg',
                'middlename' => 'Elliot',
                'department_id' => $deptEng->id,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $jayson->user_id],
            [
                'student_id' => null,
                'name' => 'Jayson',
                'lastname' => 'Lozada',
                'middlename' => 'Santos',
                'department_id' => $deptIT->id,
            ]
        );

        StudentEmployee::updateOrCreate(
            ['user_id' => $mikkoDev->user_id],
            [
                'student_id' => null,
                'name' => 'Mikko',
                'lastname' => 'Momo',
                'middlename' => 'Cruz',
                'department_id' => $deptEng->id,
            ]
        );
    }
}
