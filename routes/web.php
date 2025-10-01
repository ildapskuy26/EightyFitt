<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PetugasManagementController;
use Illuminate\Support\Facades\Route;

// ====================
// Halaman Utama
// ====================
Route::get('/', [BeritaController::class, 'index'])->name('beranda');

// Halaman statis
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
// Semua user bisa lihat daftar & detail obat
Route::resource('obat', ObatController::class)->only(['index','show']);

// CRUD Obat hanya untuk admin & petugas
Route::middleware(['auth','role:admin|petugas'])->group(function () {
    Route::resource('obat', ObatController::class)->except(['index','show']);
});

// ====================
// Dashboard masing-masing role
// ====================
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::middleware(['auth', 'role:petugas'])->get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
// Halaman home siswa
Route::middleware(['auth','role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'home'])->name('siswa.dashboard');

    // Riwayat kunjungan siswa
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
// Semua user bisa lihat daftar & detail berita
Route::resource('berita', BeritaController::class)->only(['index']);
Route::get('berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');

// CRUD berita hanya untuk admin & petugas
Route::middleware(['auth','role:admin|petugas'])->group(function () {
    Route::resource('berita', BeritaController::class)->except(['index','show'])
        ->parameters(['berita' => 'berita']);
});

// ====================
// Manajemen Petugas (khusus admin)
// ====================
Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('petugas', PetugasManagementController::class);
});
