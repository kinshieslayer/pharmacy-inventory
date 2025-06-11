<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // For debugging purposes, temporarily uncomment these lines to see logs
        // Log::info('CheckRole Middleware: Attempting to access route requiring roles: ' . implode(', ', $roles));

        $user = Auth::user();

        // If user is null here (meaning not authenticated by previous middleware),
        // we'll pass it to the next middleware (likely 'auth' middleware)
        // which will handle the redirection to login.
        if (!$user) {
            // Log::warning('CheckRole Middleware: User object is null, proceeding to default authentication.');
            return $next($request); // Let the 'auth' middleware handle it if present on the route
        }

        // Log::info('CheckRole Middleware: User authenticated. User role: ' . $user->role);
        // Log::info('CheckRole Middleware: Required roles: ' . implode(', ', $roles));

        if (!in_array($user->role, $roles)) {
            // Log::warning('CheckRole Middleware: Unauthorized access. User role: ' . $user->role . ', Required roles: ' . implode(', ', $roles));
            abort(403, 'Unauthorized action. Your role is: ' . $user->role);
        }

        // Log::info('CheckRole Middleware: Authorization successful for role: ' . $user->role);
        return $next($request);
    }
}