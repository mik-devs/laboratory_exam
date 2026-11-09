<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\authentication\ForgetController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ErrorController;

Route::get('/', fn () => view('welcome'));

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'process_login'])->name('process_login');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.process');

    Route::get('/forget', [ForgetController::class, 'index'])->name('forget');
});

// Logged-in users
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
});

// Admin only
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/charts', [AdminDashboardController::class, 'charts'])->name('charts');
    Route::get('/tables', [AdminDashboardController::class, 'tables'])->name('tables');
    Route::get('/light', [AdminDashboardController::class, 'light'])->name('light');
    Route::get('/static', [AdminDashboardController::class, 'static'])->name('static');

    // Route::resource
    Route::resource('/users', UserController::class);
});

// Error page previews (remove in production)
Route::prefix('errors')->name('errors.')->group(function () {
    Route::get('/404', [ErrorController::class, 'notFound'])->name('404');
    Route::get('/401', [ErrorController::class, 'forbidden'])->name('401');
    Route::get('/500', [ErrorController::class, 'internalServerError'])->name('500');
});