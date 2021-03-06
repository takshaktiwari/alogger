<?php

namespace Takshak\Alogger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Takshak\Alogger\Service\Alogger as AloggerService;

class Alogger
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
        if (config('alogger.log', true)) {
            (new AloggerService($request))->log();
        }
        return $next($request);
    }
}
