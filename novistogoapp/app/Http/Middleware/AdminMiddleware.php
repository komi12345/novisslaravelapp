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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Not logged in, redirect to login
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            // Logged in but not an admin or superadmin, redirect to home or dashboard
            // You might want to redirect to a specific 'unauthorized' page later
            return redirect('/dashboard')->with('error', 'Accès non autorisé.');
        }

        // User is authenticated and is an admin
        return $next($request);
    }
}
