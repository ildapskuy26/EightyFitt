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

// ====================
// Halaman Kontak
// ====================
// Kontak Routes
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak/send', [KontakController::class, 'send'])->name('kontak.send');


// ====================
// Halaman Utama
// ====================
Route::get('/', [BeritaController::class, 'index'])->name('beranda');
Route::view('/tentang', 'pages.tentang')->name('tentang');

// ====================
// Dashboard umum
// ====================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ====================
// Profile (hanya login user)
// ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ====================
// Riwayat Kunjungan
// ====================
Route::get('/riwayat', [KunjunganController::class, 'index'])->name('riwayat.index');

// ====================
// Obat
// ====================
Route::resource('obat', ObatController::class);

// ====================
// Dashboard masing-masing role
// ====================
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware(['auth', 'role:petugas'])->get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');

Route::middleware(['auth','role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'home'])->name('siswa.dashboard');
    Route::get('/siswa/riwayat', [SiswaController::class, 'riwayat'])->name('siswa.riwayat');
});

// ====================
// CRUD Kunjungan (admin + petugas)
// ====================
Route::middleware(['auth','role:admin,petugas'])->group(function () {
    Route::resource('kunjungan', KunjunganController::class);
    Route::get('/kunjungan/export/csv', [KunjunganController::class, 'exportCsv'])->name('kunjungan.export.csv');
});

// ====================
// Berita
// ====================
Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);

// ====================
// Manajemen Petugas (khusus admin)
// ====================
Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('petugas', PetugasManagementController::class);
});
Route::resource('siswa', SiswaManagementController::class)->middleware(['auth','role:admin']);

// ====================
// Google Auth
// ====================
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);
