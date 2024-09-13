<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->is_app_user === 1){
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();


            return redirect()->route('login')->with('error', "you are not allowed enter with app username and passwords!");
        }
        if(auth()->check() && (auth()->user()->role == 1 || auth()->user()->role == 0)){
            return $next($request);
        }
        return redirect()->route('login');
    }
}
