<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('adminlogin')->withErrors(['message' => 'You must be logged in to access this page.']);
        }

        // Allow the request to proceed
        return $next($request);
    }
}
