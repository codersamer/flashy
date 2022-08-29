<?php

namespace Coderrsamer\Flashy\Http\Middleware;

use Closure;
use Codersamer\Flashy\Facades\Flashy;
use Illuminate\Http\Request;

class FlashySessionMiddleware
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
        Flashy::flash();
        return $next($request);
    }
}
