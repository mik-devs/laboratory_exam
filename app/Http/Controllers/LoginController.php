<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function charts(){
        return view('admin.charts');
    }
    public function tables(){
        return view('admin.tables');
    }
    public function light(){
        return view('admin.light');
    }
    public function static(){
        return view('admin.static');
    }

    
}

