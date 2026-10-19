<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}

