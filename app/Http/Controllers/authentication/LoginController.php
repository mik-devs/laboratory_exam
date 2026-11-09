<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $student = [
        'id' => '2024-1234',
        'Fistname' => 'Mikko',
        'Year' => '3rd Year',
        'MI' => 'C',
        'Lastname' => 'Momo',
        'Course' => 'Bachelor of Science in Information Technology',
        'Address' => 'Pasig, Kiblawan Davao del Sur',
        'Status' => 'Single',
        ];
        return view('authentication.login', compact('student'));
    }

    public function __invoke(Request $request)
    {
        if ($request->isMethod('get')) {
            return $this->process_login($request);
        }
        
        return view('authentication.login');
    }

public function login(Request $request)
{

return view('authentication.login');

}

    public function process_login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = \App\Models\User::where('email', $request->input('email'))->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->input('password'), $user->password)) {
            
            if ($user->status == 0) {
                return redirect()->back()->with('danger', 'Your account is inactive. Please contact the administrator.');
            }

            Auth::login($user);
            $request->session()->regenerate();
            session()->flash('success', 'Success');

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('danger', 'Invalid username or password');
    }
}

