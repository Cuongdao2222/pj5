<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\groupProduct;
use Illuminate\Support\Facades\Cache;
use App\Models\deal;



class indexController extends Controller
{
    public function index()
    {
        $minutes = 10;

        $banners = Cache::remember('banners',$minutes, function() {
            return banners::where('option', 0)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannersRight = Cache::remember('bannersRights',$minutes, function() {
            return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSlider = Cache::remember('bannerUnderSlider',$minutes, function() {
            return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSale = Cache::remember('bannerUnderSale',$minutes, function() {
            return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();;
        });


        $deal =  Cache::remember('deal',10, function() {

            return deal::get();
         });
       
      
        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal'));
    }

     

   
}
