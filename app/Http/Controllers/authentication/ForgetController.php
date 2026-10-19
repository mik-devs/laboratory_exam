<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgetController extends Controller
{
    public function index()
    {
        return view('authentication.forget');
    }
}
