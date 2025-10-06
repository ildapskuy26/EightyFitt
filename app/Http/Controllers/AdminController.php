<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kunjungan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $obat = Obat::select('nama', 'stock')->get();
        $kunjungan = Kunjungan::selectRaw('MONTH(waktu_kedatangan) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->orderBy('bulan')->get();

        return view('admin.dashboard', compact('obat', 'kunjungan'));
    }
}