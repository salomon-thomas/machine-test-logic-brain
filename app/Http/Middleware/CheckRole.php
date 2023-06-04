<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get the user's role
            $userRole = Auth::user()->role->name;

            // Check if user has the required role
            if ($userRole === $role) {
                return $next($request);
            }
        }

        // Return JSON response for API requests
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Redirect user to a specific page (e.g., home) if they don't have access
        return redirect()->route('blogs.index')->with('error', 'You do not have permission to access this page.');
    }
}
