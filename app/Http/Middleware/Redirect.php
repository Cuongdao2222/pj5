<?php

namespace App\Http\Middleware;

use Closure;

class Redirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function getUri()
    {
       $uri = $_SERVER['REQUEST_URI'];

       return $uri;
        
    }
    public function handle($request, Closure $next)
    {
        if( $this->getUri()==='tivi' ){

            Redirect::to('https://dantri.com.vn/');

        }
        return $next($request);
    }
}
