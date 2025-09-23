<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kunjungan;

class SiswaController extends Controller
{
    public function index()
    {
        $riwayats = Kunjungan::all(); // atau query sesuai kebutuhan
    return view('riwayat', compact('riwayats'));
    }
}
