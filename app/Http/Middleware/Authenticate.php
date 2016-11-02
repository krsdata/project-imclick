<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Request;
use Redirect;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Request::segment( 1 );         
        if(isset($this->auth->user()->GroupID) && $this->auth->user()->GroupID!=4)
        {
            return redirect('/');
        }
         if ($this->auth->guest()) {

            $routeName = Request::route()->getName();

            if ($request->ajax()) {       
                return response('Unauthorized.', 401);
            } else {
                
                if($routeName=='mon-compte')
                {
                    return Redirect::back();
                }
                
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
