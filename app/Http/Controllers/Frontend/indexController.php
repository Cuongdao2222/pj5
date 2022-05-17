<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use Cache;



class indexController extends Controller
{
    public function index()
    {

        $banners = Cache::rememberForever('banners', function() {
            return banners::where('option', 0)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannersRight = Cache::rememberForever('bannersRight', function() {
            return  banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSlider = Cache::rememberForever('bannerUnderSlider', function() {
            return  banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSale  = Cache::rememberForever('bannerUnderSale', function() {
            return  banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();
        });

        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale'));
    }
   
}
