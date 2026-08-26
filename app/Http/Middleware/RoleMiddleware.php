<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!$request->user()) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Silakan login terlebih dahulu.'
                ]);
        }

        // Ambil role user
        $userRole = $request->user()->role;

        // Jika user belum memiliki role
        if (!$userRole) {
            abort(403, 'Role user tidak ditemukan.');
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        if (!in_array($userRole->name, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}