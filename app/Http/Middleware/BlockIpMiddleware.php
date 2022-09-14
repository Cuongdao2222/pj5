<?php

namespace App\Http\Middleware;

use Closure;

use DB;

class BlockIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function getIpBlock()
    {
        $ipBlock = DB::table('checkspam')->select('ip')->get();

        $ip = [];

        foreach ($ipBlock as $key => $value) {

            array_push($ip, $value->ip);
        }
        return $ip;


    }
    public function handle($request, Closure $next)
    {
       
        if (in_array($request->ip(), $this->getIpBlock())) {
            abort(403, "You are restricted to access the site.");
        }
  
        return $next($request);
    }
}
