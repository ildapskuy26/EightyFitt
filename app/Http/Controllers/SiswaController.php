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
        dd(Auth::check(), Auth::user(), Auth::getDefaultDriver());
    }
}
