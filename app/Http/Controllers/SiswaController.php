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
        return view('layouts.siswa.dashboard');
    }

    public function riwayat()
    {
        $user = Auth::user();

        // Pastikan user terhubung ke data siswa
        $siswa = Siswa::where('nis', $user->nis)->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai siswa. Riwayat tidak dapat ditampilkan.');
        }

        // Ambil kunjungan milik siswa tersebut
        $riwayats = Kunjungan::where('nis', $siswa->nis)->get();

        return view('riwayat', compact('riwayats'));
    }
}
