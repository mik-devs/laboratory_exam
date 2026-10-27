<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\authentication\ForgetController;
use App\Http\Controllers\student\DashboardController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\ErrorsController;

// Public Pages & Auth Handling
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/forget', [ForgetController::class, 'index'])->name('forget');
Route::get('/process-login', [LoginController::class, 'process_login'])->name('process_login'); 

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Dashboards (Now Open)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/charts', [AdminDashboardController::class, 'charts'])->name('admin.charts');
Route::get('/admin/tables', [AdminDashboardController::class, 'tables'])->name('admin.tables');
Route::get('/admin/light', [AdminDashboardController::class, 'light'])->name('admin.light');
Route::get('/admin/static', [AdminDashboardController::class, 'static'])->name('admin.static');

// Error Pages
Route::get('/errors/404', [ErrorsController::class, 'notFound'])->name('errors.404');
Route::get('/errors/401', [ErrorsController::class, 'forbidden'])->name('errors.401');
Route::get('/errors/500', [ErrorsController::class, 'internalServerError'])->name('errors.500');
