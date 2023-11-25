<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): mixed  $next
     */
    public function handle(Request $request, Closure $next, $rules)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();

        if ($user->level == $rules)
            return $next($request);

        return redirect('login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
