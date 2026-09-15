<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Cek apakah role user ada di dalam daftar role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika pelanggan mencoba akses halaman pemilik/teknisi, lempar ke halaman pantau servis
        if ($user->role === 'pelanggan') {
            return redirect('/status-servis')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return redirect('/')->with('error', 'Akses ditolak.');
    }
}