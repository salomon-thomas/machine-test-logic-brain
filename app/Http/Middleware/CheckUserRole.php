<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get the user's roles
            $userRoles = [Auth::user()->role->name];

            // Check if user has any of the required roles
            $allowed = array_intersect($userRoles, $roles);

            // If user has at least one allowed role, continue to the next request
            if (!empty($allowed)) {
                return $next($request);
            }
        }

        // Redirect user to a specific page (e.g., home) if they don't have access
        return redirect()->route('blogs.index')->with('error', 'You do not have permission to access this page.');
    }
}
