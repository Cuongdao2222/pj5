<?php

namespace App\Http\Middleware;

use Closure;

use DB;

use Illuminate\Support\Facades\Cache; 

use Illuminate\Support\Facades\Redirect;


class urlTo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function getUrl()
    {
        $uri = trim($_SERVER['REQUEST_URI']);

        return $uri;

    }
    public function handle($request, Closure $next)
    {
        $uri =  $this->getUrl();

        if(Cache::has('checkLinkRedirect_'.$uri)){

            $uri_redirect = Cache::get('checkLinkRedirect_'.$uri);

            return redirect()->to($uri_redirect);

        }

        return $next($request);
       
    }
}
