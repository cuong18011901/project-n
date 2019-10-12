<?php

namespace App\Http\Middleware;

use Closure;

class SponsorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isset($request->user()->sponsor)) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
