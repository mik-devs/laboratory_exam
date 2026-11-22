<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->studentEmployee;

        return view('user.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $profile = $user->studentEmployee;

        $rules = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];

        if ($profile) {
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['lastname'] = ['required', 'string', 'max:255'];
            $rules['middlename'] = ['nullable', 'string', 'max:255'];
            $rules['student_id'] = [
                'nullable',
                'string',
                'max:255',
                Rule::unique('student_employees', 'student_id')->ignore($profile->id),
            ];
        }

        $validated = $request->validate($rules);

        $userData = ['email' => $validated['email']];

        if ($request->filled('password')) {
            $userData['password'] = $validated['password'];
        }

        $user->update($userData);

        if ($profile) {
            $profile->update([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'middlename' => $validated['middlename'] ?? null,
                'student_id' => $validated['student_id'] ?? null,
            ]);
        }

        return redirect()
            ->route('user.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
