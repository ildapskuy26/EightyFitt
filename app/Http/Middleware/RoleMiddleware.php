<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek guard yang aktif (web atau siswa)
        $guard = Auth::guard('siswa')->check() ? 'siswa' : 'web';
        $user = Auth::guard($guard)->user();

        // Kalau tidak login sama sekali
        if (!$user) {
            if ($guard === 'siswa') {
                return redirect()->route('siswa.login')->with('error', 'Silakan login sebagai siswa.');
            } else {
                return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
            }
        }

        // Ambil role user
        $userRole = $user->role ?? 'siswa'; // fallback 'siswa' kalau pakai model siswa tanpa kolom role

        // Jika tidak punya hak akses
        if (!in_array($userRole, $roles)) {
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak!');
                case 'petugas':
                    return redirect()->route('petugas.dashboard')->with('error', 'Akses ditolak!');
                case 'siswa':
                    return redirect()->route('siswa.dashboard')->with('error', 'Akses ditolak!');
                default:
                    abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
