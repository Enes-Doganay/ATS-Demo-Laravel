<?php

namespace App\Http\Middleware;

use App\Shared\Exceptions\ForbiddenError;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
public function handle($request, \Closure $next, ...$roles)
{
    $user = $request->user();
    if (!$user) {
        throw new ForbiddenError();
    }

    $userRole = is_object($user->role) && method_exists($user->role, 'value')
        ? $user->role->value
        : (is_string($user->role) ? $user->role : (string)$user->role);

    $roles = array_map('strtolower', $roles);
    if (!in_array(strtolower($userRole), $roles)) {
        throw new ForbiddenError();
    }
    return $next($request);
}

}