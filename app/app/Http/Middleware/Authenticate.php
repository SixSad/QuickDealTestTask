<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Unauthenticated'],401);
        }

        // other checks

        return $next($request);
    }
}
