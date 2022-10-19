<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
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
        // if is admin contunie
        if (auth()->check() && auth()->user()->role == 1) {
            return $next($request);
        } else {
            // if not admin show 403 page
            abort(403, 'You don\'t have permission to access this page');
        }
    }
}
