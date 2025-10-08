<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Events\SiswaRegistered;

class SiswaAuthController extends Controller
{
    /**
     * Tampilkan halaman login siswa
     */
    public function showLoginForm()
    {
        return view('auth.siswa-login');
    }

    /**
     * Proses login siswa
     */
    public function login(Request $request)
{
    $credentials = $request->validate([
        'nis' => 'required|string',
        'password' => 'required|string',
    ]);

    // Gunakan guard siswa
    if (Auth::guard('siswa')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        
        return redirect()->intended(route('siswa.dashboard'))->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
        'nis' => 'NIS atau password salah.',
    ]);
    }

    /**
     * Tampilkan form registrasi siswa baru
     */
    public function showRegisterForm()
    {
        return view('auth.siswa-register');
    }

    /**
     * Proses registrasi siswa baru
     */
    public function register(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Cari apakah nama siswa cocok di tabel siswa
    $siswa = \App\Models\Siswa::where('nama', $request->name)->first();

    // Buat akun user baru
    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'nis' => $siswa ? $siswa->nis : null,
    ]);

    // Jika cocok dengan data siswa, tautkan ke NIS
    if ($siswa) {
        $user->nis = $siswa->nis;
        $user->save();
    }

    // Login otomatis setelah registrasi
    Auth::login($user);

    return redirect()->route('dashboard')
        ->with('status', $siswa
            ? 'Registrasi berhasil! Akun Anda telah terhubung dengan data siswa.'
            : 'Registrasi berhasil! Namun data Anda tidak ditemukan di database siswa, akses dibatasi.');
    }

    /**
     * Logout siswa
     */
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login')->with('status', 'Anda telah logout.');
    }
}
