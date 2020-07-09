<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // check req if req dashboard/any thing got to dashboard else login site
            if(Request::is('dashboard/*'))
            return redirect()->route('dashboard.login');
            else
            return route('login');
        }
    }
}
