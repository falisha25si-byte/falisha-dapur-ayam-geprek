<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Hanya user dengan role yang diizinkan yang boleh lanjut.
     * Contoh di route: ->middleware('checkrole:Admin')
     * Role tidak cocok -> error 403.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        if (!in_array($user->role, $roles, true)) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}
