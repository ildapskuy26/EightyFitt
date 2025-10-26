<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Cek apakah siswa ada di database
    $siswa = \App\Models\Siswa::where('nama', $request->name)->first();

    if (!$siswa) {
        return back()->withErrors(['name' => 'Nama ini tidak terdaftar di data siswa.']);
    }

    // Buat user baru dengan NIS dari tabel siswa
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'nis' => $siswa->nis, // relasi langsung
        'role' => 'siswa', // opsional: beri role default
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->route('dashboard');
}

}
