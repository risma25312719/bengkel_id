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

                if ($user->role === 'teknisi') {
                    if ($user->status_bengkel !== 'approved') {
                        Auth::guard($guard)->logout();

                        return redirect('/login');
                    }

                    return redirect('/dashboard');
                }

                return redirect('/status-servis');
            }
        }

        return $next($request);
    }
}
