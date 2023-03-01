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

        return $uri;
    }
    public function handle($request, Closure $next)
    {
       
        if($this->getUrl()==='/binh-thuy-dien-panasonic-22-lit-nc-eg2200csy'){

           return redirect()->to('https://dienmaynguoiviet.vn/binh-thuy-dien-panasonic-2-2-lit-nc-eg2200csy');
        }
        else{
            return $next($request);
        }

        
    }
}
