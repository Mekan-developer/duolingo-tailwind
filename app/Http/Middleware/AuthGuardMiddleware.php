<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthGuardMiddleware
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        // Check if the user is authenticated using the specified guard
        if (!Auth::guard($guard)->check()) {
     
            // If not authenticated, redirect to the login page or return an unauthorized response
            return redirect()->route('login');  // or return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Allow the request to continue if authenticated
        return $next($request);
    }
}
