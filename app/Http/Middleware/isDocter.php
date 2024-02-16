<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isDocter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response




    {
        if(Auth::check() && Auth::user()->role == 'docter') {
            // Proses yang ingin dilakukan untuk admin
            return $next($request);
        } else {
            return redirect('/sesi')->withErrors('Anda Tidak Memiliki Akses');
        }
    }
}
