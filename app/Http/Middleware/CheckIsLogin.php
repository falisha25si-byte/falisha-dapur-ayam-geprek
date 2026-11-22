<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogin
{
    /**
     * Hanya user yang sudah login yang boleh lanjut.
     * Belum login -> dialihkan ke halaman login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
}
