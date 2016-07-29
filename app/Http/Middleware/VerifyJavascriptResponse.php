<?php

namespace App\Http\Middleware;

use Closure;
use Efficiently\JqueryLaravel\VerifyJavascriptResponse as BaseVerifier;

class VerifyJavascriptResponse extends BaseVerifier
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return parent::handle($request, $next);
    }
}
