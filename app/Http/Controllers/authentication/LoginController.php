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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'status'   => 1,
        ];
      

        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            session()->flash('success', 'Success');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('danger', 'Invalid username or password');
    }


}

