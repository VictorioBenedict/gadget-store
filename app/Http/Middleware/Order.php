<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Order
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user(); // Assuming you're using authentication middleware

        if ($user && $user->email) {
            return $next($request);
        }

        // Handle case where user or email is null
        abort(403, 'Unauthorized'); // Or redirect, return response, etc.
    }
}
