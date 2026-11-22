<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\ErrorController;
use App\Http\Controllers\admin\StudentEmployeeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\authentication\ForgetController;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'process_login'])->name('process_login');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.process');

    Route::get('/forget', [ForgetController::class, 'index'])->name('forget');
});

// Logout
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});

// Student / Employee routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin only
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/charts', [AdminDashboardController::class, 'charts'])->name('charts');
    Route::get('/tables', [AdminDashboardController::class, 'tables'])->name('tables');
    Route::get('/light', [AdminDashboardController::class, 'light'])->name('light');
    Route::get('/static', [AdminDashboardController::class, 'static'])->name('static');

    Route::resource('/users', UserController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/student-employees', StudentEmployeeController::class);
});

Route::prefix('errors')->name('errors.')->group(function () {
    Route::get('/404', [ErrorController::class, 'notFound'])->name('404');
    Route::get('/401', [ErrorController::class, 'forbidden'])->name('401');
    Route::get('/500', [ErrorController::class, 'internalServerError'])->name('500');
});
