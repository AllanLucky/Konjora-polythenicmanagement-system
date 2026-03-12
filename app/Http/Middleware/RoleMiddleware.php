<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Not logged in
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Account inactive
        if ($user->status != 1) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is inactive.');
        }

        // Role mismatch
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        // All good, proceed
        return $next($request);
    }
}