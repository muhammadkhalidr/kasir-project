<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLevelUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): mixed  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $level = $user->level;

        switch ($level) {
            case 1:
                return $next($request);
            case 2:
                return $next($request);
            case 3:
                return $next($request);
            default:
                return redirect('login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
}
