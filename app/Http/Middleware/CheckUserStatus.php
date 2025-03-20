<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Periksa status pengguna
            if (Auth::user()->status == 1) {
                return $next($request); // Lanjutkan ke route yang diminta
            } else {
                // Jika status tidak 1, redirect ke halaman lain (misalnya, halaman error atau login)
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        // Jika pengguna belum login, redirect ke halaman login
        return redirect()->route('login');
    }
}
