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
        $uri = $_SERVER['REQUEST_URI'];

        $checkLink = Cache::rememberForever('link_redirect', function() use($uri){

            $checkLink = DB::table('redirect')->select('target_path')->where('request_path', $uri)->get()->first();

            return $checkLink??'';
        });

        
        return $checkLink;

    }
    public function handle($request, Closure $next)
    {

        $checkLink = $this->getUrl();

        if(!empty($checkLink)){

            return redirect()->to($checkLink->target_path);

        }
        return $next($request);
       
    }
}
