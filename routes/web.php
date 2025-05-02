<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/pimpinan', [NavbarController::class, 'pimpinan']);
Route::get('/pesantren', [NavbarController::class, 'pesantren']);

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Static Page Routes
Route::get('/pimpinan', function () {
    return view('pimpinan');
});

Route::get('/pesantren', function () {
    return view('pesantren');
});

Route::get('/kegiatan', function () {
    return view('kegiatan');
});

Route::get('/madin', function () {
    return view('madin');
});

Route::get('/smp', function () {
    return view('smp');
});

Route::get('/pendidikan', [PendidikanController::class, 'index']);

Route::get('/syariah-pondok', function () {
    return view('syariah-pondok');
});

Route::get('/syariah-smp', function () {
    return view('syariah-smp');
});

Route::get('/kontak', function () {
    return view('kontak');
});

// Gallery Routes
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Registration Routes
Route::get('/pendaftaran', [RegistrationController::class, 'index'])->name('registration.index');
Route::get('/pendaftaran/{type}', [RegistrationController::class, 'show'])->name('registration.show');

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

        Route::resource('news', \App\Http\Controllers\Admin\NewsController::class, [
            'as' => 'admin'
        ]);

        Route::resource('registration', \App\Http\Controllers\Admin\RegistrationPageController::class, [
            'as' => 'admin'
        ]);

        Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class, [
            'as' => 'admin'
        ]);

        Route::post('gallery/update-order', [\App\Http\Controllers\Admin\GalleryController::class, 'updateOrder'])
             ->name('admin.gallery.update-order');

        Route::resource('activities', \App\Http\Controllers\Admin\ActivityController::class, [
            'as' => 'admin'
        ]);
        
        Route::post('activities/update-order', [\App\Http\Controllers\Admin\ActivityController::class, 'updateOrder'])
             ->name('admin.activities.update-order');
         
        Route::post('activities/{activity}/gallery/upload', [\App\Http\Controllers\Admin\GalleryController::class, 'uploadMultiple'])
             ->name('admin.activities.gallery.upload');

        Route::post('activities/{activity}/gallery/chunk-upload', [\App\Http\Controllers\Admin\GalleryController::class, 'handleChunkUpload'])
             ->name('admin.activities.gallery.chunk-upload');

        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::post('password/update', [AuthController::class, 'updatePassword'])->name('admin.password.update');
    });
});