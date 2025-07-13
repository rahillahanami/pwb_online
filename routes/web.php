<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaRegistrationController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectAfterLogin;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/pendaftaran/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.pendaftaran.pdf');


Route::get('/cek-email', function () {
    $email = request('email');
    $exists = User::where('email', $email)->exists();

    return response()->json(['exists' => $exists]);
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (auto-redirect by role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', RedirectAfterLogin::class])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes (authenticated only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');

    // Manajemen User
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Data Pendaftaran Mahasiswa
    Route::get('/admin/pendaftaran', [AdminController::class, 'pendaftaran'])->name('admin.pendaftaran');
    Route::delete('/admin/pendaftaran/{id}', [AdminController::class, 'deletePendaftaran'])->name('admin.pendaftaran.delete');
    Route::get('/admin/pendaftaran/{id}/edit', [AdminController::class, 'editPendaftaran'])->name('admin.pendaftaran.edit');
    Route::put('/admin/pendaftaran/{id}', [AdminController::class, 'updatePendaftaran'])->name('admin.pendaftaran.update');


    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
});

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');

    // Pendaftaran Mahasiswa Baru
    Route::get('/mahasiswa/pendaftaran', [MahasiswaRegistrationController::class, 'create'])->name('mahasiswa.registration.create');
    Route::post('/mahasiswa/pendaftaran', [MahasiswaRegistrationController::class, 'store'])->name('mahasiswa.registration.store');
    Route::get('/mahasiswa/pendaftaran/lihat', [MahasiswaRegistrationController::class, 'show'])->name('mahasiswa.registration.show');
});

/*
|--------------------------------------------------------------------------
| API Wilayah
|--------------------------------------------------------------------------
*/
Route::get('/api/kabupaten', [WilayahController::class, 'getKabupaten']);

Route::get('/mahasiswa/pendaftaran/pdf', [MahasiswaRegistrationController::class, 'exportPDF'])->name('mahasiswa.registration.pdf');

Route::get('/admin/pendaftaran/export', [AdminController::class, 'exportExcel'])->name('admin.pendaftaran.export');


require __DIR__ . '/auth.php';
