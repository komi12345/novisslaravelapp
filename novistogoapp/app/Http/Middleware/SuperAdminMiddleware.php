<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
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

        if (Auth::user()->role !== 'superadmin') {
            // Logged in but not a superadmin, redirect to dashboard or an unauthorized page
            return redirect('/dashboard')->with('error', 'Accès réservé aux super administrateurs.');
        }

        return $next($request);
    }
}
