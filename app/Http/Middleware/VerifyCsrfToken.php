<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Request;
use Redirect;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    
    protected function excludedRoutes($request)  
	{
	    $routes = [
	            'paypal_ipn',
	            'paypal_ipn'
	    ];

	    foreach($routes as $route)
	        if ($request->is($route))
	            return true;

	        return false;
	}

    public function handle($request, Closure $next)  
	{
	    if ($this->isReading($request) || $this->excludedRoutes($request) || $this->tokensMatch($request))
	    {
	        return $this->addCookieToResponse($request, $next($request));
	    }

	    throw new TokenMismatchException;
	}
}
