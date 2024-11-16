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
        $userRoles = $user->roles->pluck('id')->toArray();

        if (!array_intersect($userRoles, $roles)) {
            return response()->redirectTo('login')->with('error', 'anda belum login');
        }

        return $next($request);
    }
}
