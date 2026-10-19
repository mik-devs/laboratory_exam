<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function notFound(){
        return response()->view('errors.404', [], 404);
    }
    public function forbidden(){
        return response()->view('errors.401', [], 401);
    }
    public function internalServerError(){
        return response()->view('errors.500', [], 500);
    }
}
