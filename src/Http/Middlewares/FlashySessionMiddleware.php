<?php

namespace Codersamer\Flashy\Http\Middlewares;

use Closure;
use Codersamer\Flashy\Facades\Flashy;

class FlashySessionMiddleware
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        Flashy::restore();

        $next = $next($request);

        Flashy::flash();

        return $next;
    }
}
