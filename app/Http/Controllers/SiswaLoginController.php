<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.siswa-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('siswa')->attempt([
            'nis' => $request->nis,
            'password' => $request->password
        ])) {
            return redirect()->route('layouts.siswa.dashboard');
        }

        return back()->withErrors(['login_error' => 'NIS atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('siswa')->logout();
        return redirect()->route('siswa.login');
    }
}
