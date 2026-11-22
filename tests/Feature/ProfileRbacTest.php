<?php

use App\Models\StudentEmployee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('non-admin users are redirected away from admin routes', function () {
    $student = User::factory()->create(['user_type' => 'student']);

    $this->actingAs($student)
        ->get(route('admin.dashboard'))
        ->assertRedirect(route('user.dashboard'))
        ->assertSessionHas('error');
});

test('a user can update their own account and profile', function () {
    $user = User::factory()->create([
        'user_type' => 'student',
        'email' => 'old@example.com',
    ]);

    $profile = StudentEmployee::create([
        'user_id' => $user->user_id,
        'student_id' => '2024-9001',
        'name' => 'Old',
        'lastname' => 'Name',
        'middlename' => 'M',
    ]);

    $this->actingAs($user)
        ->put(route('user.profile.update'), [
            'email' => 'new@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
            'name' => 'New',
            'lastname' => 'Name',
            'middlename' => 'M',
            'student_id' => '2024-9002',
        ])
        ->assertRedirect(route('user.profile.edit'))
        ->assertSessionHas('success');

    expect($user->fresh()->email)->toBe('new@example.com');
    expect($profile->fresh()->name)->toBe('New');
    expect($profile->fresh()->student_id)->toBe('2024-9002');
});
