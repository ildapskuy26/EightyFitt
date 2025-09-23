<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use \App\Http\Controllers\InventarisObatController;

// Beranda
Route::view('/', 'pages.beranda')->name('beranda');

// Halaman statis
Route::view('/obat', 'pages.obat')->name('obat');
Route::view('/tentang', 'pages.tentang')->name('tentang');

// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (hanya untuk user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Riwayat Kunjungan (pakai controller, bukan view)
Route::get('/riwayat', [KunjunganController::class, 'index'])->name('riwayat.index');

// Dashboard masing-masing role
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::middleware(['auth', 'role:petugas'])->get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
Route::middleware(['auth', 'role:siswa'])->get('/', [SiswaController::class, 'index']);

// Resource routes untuk Kunjungan (hanya untuk admin dan petugas)
Route::middleware(['auth','role:admin,petugas'])->group(function(){
    Route::resource('kunjungan', KunjunganController::class);

    Route::middleware(['auth','role:admin,petugas'])->group(function(){
    Route::resource('obat', ObatController::class);});
});
