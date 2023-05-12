<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as AuthMiddleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class Authenticate extends AuthMiddleware
{

    protected function unauthenticated($request, array $guards)
    {

        if( $request->expectsJson()){
            throw new HttpResponseException(baseJsonResponse(null, 401, false, 'Unauthenticated'));
        }

        parent::unauthenticated($request, $guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
