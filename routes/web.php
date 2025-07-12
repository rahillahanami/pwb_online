<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaRegistrationController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});

Route::middleware(['auth', RoleMiddleware::class . ':mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
});

Route::get('/dashboard/admin', function () {
    return view('dashboard.admin');
})->middleware(['auth', 'role:admin'])->name('dashboard.admin');

Route::get('/dashboard/mahasiswa', function () {
    return view('dashboard.mahasiswa');
})->middleware(['auth', 'role:mahasiswa'])->name('dashboard.mahasiswa');


Route::middleware(['auth', RoleMiddleware::class . ':mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/pendaftaran', [MahasiswaRegistrationController::class, 'create'])->name('mahasiswa.registration.create');

    Route::post('/mahasiswa/pendaftaran', [MahasiswaRegistrationController::class, 'store'])->name('mahasiswa.registration.store');

    Route::get('/mahasiswa/pendaftaran/lihat', [MahasiswaRegistrationController::class, 'show'])->name('mahasiswa.registration.show');
});


require __DIR__ . '/auth.php';
