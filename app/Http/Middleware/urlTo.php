<?php

namespace App\Http\Middleware;

use Closure;

use DB;

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

        $checkLink = DB::table('redirect')->select('target_path')->where('request_path', $uri)->get()->first();

        return $checkLink;

    }
    public function handle($request, Closure $next)
    {
        if(!empty($checkLink)){

            return redirect()->to($checkLink->target_path);

        }
        return $next($request);
       
    }
}
