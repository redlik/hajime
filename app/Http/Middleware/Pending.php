<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pending
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
        if ($request->user()->status != 'active') {
            abort(403, 'Your account is not activated yet');
        }

        return $next($request);
    }
}
