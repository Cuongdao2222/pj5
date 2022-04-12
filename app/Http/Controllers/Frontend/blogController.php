<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;

class blogController extends Controller
{
    public function index()
    {
        $data = post::select('title','content', 'id', 'image', 'link')->orderBy('id','desc')->paginate(10);
        return view('frontend.blog',compact('data'));
    }
    
}
