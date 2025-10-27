<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

    if ($user->role == 'siswa') {
        // Ambil hanya riwayat milik siswa tersebut
        $riwayat = \App\Models\Kunjungan::with(['obat'])
            ->where('nis', $user->nis)
            ->orderBy('waktu_kedatangan', 'desc')
            ->take(5)
            ->get();
    } else {
        // Admin / petugas bisa lihat data lain (misal statistik umum)
        $riwayat = \App\Models\Kunjungan::latest()->take(5)->get();
    }

    return view('dashboard', compact('riwayat'));
    }
public function welcome()
{
    return view('welcome');
}
}
