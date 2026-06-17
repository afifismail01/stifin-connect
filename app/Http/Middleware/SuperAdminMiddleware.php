<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRoleEnum;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (
            ! auth()->check()
            || auth()->user()->role !== UserRoleEnum::SUPER_ADMIN
        ) {

            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}