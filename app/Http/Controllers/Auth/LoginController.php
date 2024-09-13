<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{

    public function create(): View
    {
        return View('auth.login');
    }

    public function store(Request $request)
    {
        // Validate email and password input
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    
    // Capture credentials from the request
    $credentials = $request->only('email', 'password');
     
    // Attempt to log in the user using session-based authentication
    if (!Auth::attempt($credentials)) {
        
        // If authentication fails, return an unauthorized response
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    // Get the authenticated user
    $user = Auth::user();
    Auth::login($user);

    return redirect()->intended(route('dashboard', absolute: false));

    }
}
