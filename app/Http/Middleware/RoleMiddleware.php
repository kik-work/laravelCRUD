<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        /** @var User|null $user */
        $user = $request->user();

        if (!$user || !$user->hasRole($role)) {
            abort(403);
        }

        return $next($request);
    }
}
