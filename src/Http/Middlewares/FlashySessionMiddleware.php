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

        if (session()->get('errors')) {
            $errors = session()->get('errors');
            if ($errors instanceof \Illuminate\Support\ViewErrorBag) {
                $bag = $errors->getMessagesBag();
                foreach ($bag as $message) {
                    Flashy::error($message);
                }
            }
        }
        Flashy::flash();

        return $next;
    }
}
