<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\student\DashboardController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\authentication\ForgetController;
use App\Http\Controllers\admin\ErrorsController;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/forget', [ForgetController::class, 'index'])->name('forget');

// Student Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/charts', [AdminDashboardController::class, 'charts'])->name('admin.charts');
Route::get('/admin/tables', [AdminDashboardController::class, 'tables'])->name('admin.tables');
Route::get('/admin/light', [AdminDashboardController::class, 'light'])->name('admin.light');
Route::get('/admin/static', [AdminDashboardController::class, 'static'])->name('admin.static');

//Error Routes
Route::get('/error/404', [ErrorsController::class, 'notFound'])->name('errors.404');
Route::get('/error/401', [ErrorsController::class, 'forbidden'])->name('errors.401');
Route::get('/error/500', [ErrorsController::class, 'internalServerError'])->name('errors.500');



