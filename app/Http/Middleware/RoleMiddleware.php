<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userRole = auth()->user()->role;

        if (!in_array($userRole, $roles)) {
            // Redirect ke dashboard sesuai role jika akses ditolak
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak!');
                case 'petugas':
                    return redirect()->route('petugas.dashboard')->with('error', 'Akses ditolak!');
                case 'siswa':
                    return redirect()->route('/');
                default:
                    abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
