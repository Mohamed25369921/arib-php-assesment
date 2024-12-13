<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // If the current request is already at the correct route, skip redirecting
            if ($role === 'admin' && $request->routeIs('admin.dashboard')) {
                return $next($request);
            } elseif ($role === 'manager' && $request->routeIs('employees.index')) {
                return $next($request);
            } elseif ($role === 'employee' && $request->routeIs('tasks.index')) {
                return $next($request);
            }

            // Redirect based on user role
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'manager':
                    return redirect()->route('employees.index');
                case 'employee':
                    return redirect()->route('tasks.index');
            }
        }

        // Redirect guests to login if they are not authenticated
        return redirect()->route('login');
    }
}
