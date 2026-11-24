<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if ($user->role === 'admin') {
                    return redirect('/admin/bengkel');
                }

                if ($user->role === 'pemilik_bengkel') {
                    return redirect('/dashboard');
                }

                if ($user->role === 'teknisi') {
                    return redirect('/transaksi');
                }

                return redirect('/status-servis');
            }
        }

        return $next($request);
    }
}
