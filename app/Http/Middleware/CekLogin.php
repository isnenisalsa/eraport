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
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Periksa apakah user sudah login
        if (!$user) {
            return   abort(403, 'Anda Tidak Memiliki Akses.');
        }

        // Ambil role user
        $userRoles = $user->roles->pluck('id')->toArray();

        // Periksa apakah ada role yang sesuai
        if (!array_intersect($userRoles, $roles)) {
            return   abort(403, 'Role anda tidak sesuai.');
        }

        // Lanjutkan ke request berikutnya
        return $next($request);
    }
}
