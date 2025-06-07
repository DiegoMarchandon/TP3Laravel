<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if(!$user || !$user->role !== 'admin') {
            // If the user is not authenticated or not an admin, redirect to home
            return redirect()->route('home.index')->with('error', 'No tenés permiso para acceder a esta sección.');
        }
        return $next($request);
    }
}
