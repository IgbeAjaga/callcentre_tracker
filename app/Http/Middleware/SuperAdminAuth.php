<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is a superadmin
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return $next($request);
        }

        // If the user is not a superadmin, redirect to the index page
        return redirect()->route('/')->with('error', 'You do not have permission to access this page !');
    }
}
