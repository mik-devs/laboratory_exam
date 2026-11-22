<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('authentication.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'username'  => $validated['username'],
            'email'     => $validated['email'],
            'password'  => $validated['password'],
            'user_type' => 'student',
            'status'    => 1,
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Account created successfully!');
    }
}
