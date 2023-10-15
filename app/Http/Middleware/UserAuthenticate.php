<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class UserAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('user.login');
    }
    protected function authenticate($request, array $guards)
    {
        $guard = "web";
        if ($this->auth->guard($guard)->check()) {
            return $this->auth->shouldUse($guard);
        }

        $this->unauthenticated($request, $guards);
    }
}
