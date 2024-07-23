<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerCareAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is a customer care
        if (Auth::check() && Auth::user()->role === 'customercare') {
            return $next($request);
        }

        // If the user is not a customer care, redirect to the index page
        return redirect()->route('/')->with('error', 'You do not have permission to access this page !');
    }
    }
}
