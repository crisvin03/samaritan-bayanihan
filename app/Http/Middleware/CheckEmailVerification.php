<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Check if email is verified
        if (!$user->email_verified_at) {
            // Redirect to email verification page
            return redirect()->route('verify-email')
                ->with('error', 'Please verify your email address before accessing the dashboard.')
                ->with('email', $user->email);
        }

        return $next($request);
    }
}