<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            // Redirect to appropriate login page based on role
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.login');
                case 'barangay_treasurer':
                    return redirect()->route('treasurer.login');
                default:
                    return redirect()->route('login');
            }
        }

        $user = auth()->user();
        
        // Load the role relationship if not already loaded
        if (!$user->relationLoaded('role')) {
            $user->load('role');
        }

        if (!$user->role || $user->role->name !== $role) {
            abort(403, 'Unauthorized access. You do not have the required role.');
        }

        return $next($request);
    }
}