<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use Cache;

class blogController extends Controller
{
    public function index()
    {

        $data  = Cache::get('data');
        if(empty($data)){

            $datas = post::select('title','content', 'id','category','image', 'link')->orderBy('date_post','desc')->paginate(10);
            Cache::put('data',  $datas, $seconds = 10000);

            $data = Cache::get('data');

        }
        return view('frontend.blog',compact('data'));
    }
    
}
