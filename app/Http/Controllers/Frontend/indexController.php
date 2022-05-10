<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;



class indexController extends Controller
{
    public function index()
    {

        $banners = banners::where('option', 0)->where('active', 1)->get();

        $bannersRight = banners::where('option', 2)->where('active', 1)->get();

        $bannerUnderSlider = banners::where('option', 3)->where('active', 1)->get();
        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider'));
    }
   
}
