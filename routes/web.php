<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PetugasManagementController;
use App\Http\Controllers\SiswaManagementController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\SiswaAuthController;

// ====================
// Halaman Utama
// ====================
Route::get('/', [BeritaController::class, 'index'])->name('beranda');
Route::view('/tentang', 'pages.tentang')->name('tentang');

// ====================
// Halaman Kontak
// ====================
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak/send', [KontakController::class, 'send'])->name('kontak.send');

// ====================
// Login & Register Siswa (guard: siswa)
// ====================
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SiswaAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [SiswaAuthController::class, 'logout'])->name('logout');

    Route::get('/register', [SiswaAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [SiswaAuthController::class, 'register'])->name('register.submit');

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'home'])->name('dashboard');
        Route::get('/riwayat', [SiswaController::class, 'riwayat'])->name('riwayat');
        Route::get('/profile', [App\Http\Controllers\SiswaProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/password', [App\Http\Controllers\SiswaProfileController::class, 'updatePassword'])->name('profile.password');
    });
});

// ====================
// Dashboard umum (user default, mis. admin/petugas)
// ====================
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ====================
// Profile (user default, bukan siswa)
// ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ====================
// Dashboard per Role
// ====================
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware(['auth', 'role:petugas'])->get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');

// ====================
// CRUD Kunjungan (admin + petugas)
// ====================
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('kunjungan', KunjunganController::class);
    Route::get('/kunjungan/export/csv', [KunjunganController::class, 'exportCsv'])->name('kunjungan.export.csv');
    Route::get('/kunjungan/laporan', [KunjunganController::class, 'laporan'])->name('kunjungan.laporan');
});

// ====================
// CRUD Obat & Berita
// ====================
Route::resource('obat', ObatController::class);
Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);

// ====================
// Manajemen Petugas & Siswa (khusus admin)
// ====================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('petugas', PetugasManagementController::class);
    Route::resource('siswa', SiswaManagementController::class);
});

// ====================
// Google Auth
// ====================
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);
