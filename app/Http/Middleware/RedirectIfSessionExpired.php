<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfSessionExpired
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()) {
            Auth::logout();
            return redirect()->route('login')->with('message', 'Tu sesión a expirado, favor ingresar nuevamente al aplicativo.');
        }

        return $next($request);
    }
}
