<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});

// Login route alias for Laravel's default auth system
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Guest routes
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AuthController::class, 'login']);
    });

    // Protected Admin Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::post('password/update', [AuthController::class, 'updatePassword'])->name('admin.password.update');
    });
});
