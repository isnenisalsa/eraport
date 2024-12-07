<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna login menggunakan guard 'siswa'
        if (Auth::guard('siswa')->check()) {
            return $next($request);
        }

        // Jika bukan siswa, beri respons tidak diizinkan
        abort(403, 'Akses ini khusus untuk siswa.');
    }
}
