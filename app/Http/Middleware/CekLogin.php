<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {

        if (!Auth::check()) {
            return redirect('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // Ambil pengguna yang terautentikasi
        $user = Auth::user();

        // Periksa apakah peran pengguna sesuai dengan peran yang dibutuhkan
        if ($user->roles_id == $roles) {
            return $next($request); // Izinkan akses
        }
        // Arahkan jika pengguna tidak memiliki peran yang diperlukan
        return redirect('login')->withInput()->withErrors(['akses' => 'anda tidak memiliki akses']);
    }
}
