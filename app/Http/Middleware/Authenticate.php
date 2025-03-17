<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // Comment this out temporarily for development
        // if (!$request->expectsJson()) {
        //     return route('login');
        // }
    }
} 