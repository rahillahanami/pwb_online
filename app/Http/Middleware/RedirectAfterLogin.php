<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectAfterLogin
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Hanya jalankan jika user baru login (URL: /dashboard)
        if ($request->is('dashboard') && auth()->check()) {
            $user = auth()->user();

            return match ($user->role) {
                'admin' => redirect()->route('dashboard.admin'),
                'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
                default => $response
            };
        }

        return $response;
    }
}
