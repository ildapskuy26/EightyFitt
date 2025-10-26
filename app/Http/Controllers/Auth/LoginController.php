<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    // Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback()
    {
        try {
            // Stateless untuk menghindari InvalidStateException
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google gagal: '.$e->getMessage());
        }

        // Buat user baru atau ambil yang sudah ada
        $user = User::firstOrCreate(
    ['email' => $googleUser->getEmail()],
    [
        'name' => $googleUser->getName(),
        'role' => 'siswa',
        'password' => bcrypt(\Str::random(16)), // password acak
    ]
);

        // Login user
        auth()->login($user);

        // Redirect ke dashboard siswa
        return redirect('/dashboard');
    }
}
