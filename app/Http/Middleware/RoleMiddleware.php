<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    // Cek apakah user sudah login dan role-nya sesuai
    if (auth()->check() && auth()->user()->role === $role) {
        return $next($request);
    }
    // Jika bukan role-nya, tolak akses
    abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk tindakan ini.');
}
}
