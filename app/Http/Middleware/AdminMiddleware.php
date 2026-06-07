<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Check if the logged-in user has the "admin" role.
     * If not, redirect them back to the home page.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if the user role is "admin"
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Access denied. Admins only.');
        }

        // User is admin, allow the request to continue
        return $next($request);
    }
}

