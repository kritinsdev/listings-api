<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            abort(401, 'Authentication Required.');
            return null; // Explicitly return null if aborting.
        }
        return null; // You might want to replace this with the URL you want to redirect to.
    }
    
}
