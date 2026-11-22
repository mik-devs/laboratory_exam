<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn ($q, $s) => $q
                ->where('username', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%"))
            ->orderBy('user_id', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username'  => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'user_type' => ['required', Rule::in(['student', 'admin', 'employee'])],
            'status'    => ['required', 'boolean'],
        ]);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'username'  => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->user_id, 'user_id')],
            'email'     => ['required', 'email', Rule::unique('users', 'email')->ignore($user->user_id, 'user_id')],
            'password'  => ['nullable', 'string', 'min:6', 'confirmed'],
            'user_type' => ['required', Rule::in(['student', 'admin', 'employee'])],
            'status'    => ['required', 'boolean'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if ($user->user_id === auth()->id()) {
            return back()->with('danger', 'You cannot delete your own account.');
        }

        if ($user->user_type === 'admin') {
            return redirect()->route('admin.users.index')->with('danger', 'The Administrator account cannot be deactivated.');
        }

        $user->update([
            'status' => 0,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User has been deactivated successfully.');
    }
}
