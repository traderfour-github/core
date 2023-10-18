<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetAcceptRequestHeaderParameterToApplicationJson
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
        if ($request->is('v*')) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
