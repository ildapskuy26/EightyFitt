<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{

    public function home()
    {
        return view('siswa.dashboard');
    }

    public function riwayat()
    {
        $user = Auth::guard('siswa')->user();

        if (!$user) {
            return redirect()->route('siswa.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil kunjungan siswa berdasarkan nis
        $riwayat = Kunjungan::with('obat')
            ->where('nis', $user->nis)
            ->orderBy('waktu_kedatangan', 'desc')
            ->paginate(10);

        return view('siswa.riwayat', compact('riwayat'));
    }
}
