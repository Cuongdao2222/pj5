<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\groupProduct;
use App\Models\deal;
use Illuminate\Support\Facades\Cache;
use DB;



class indexController extends Controller
{
    public function index()
    {

        $banners = Cache::rememberForever('banners', function() {
            return banners::where('option', 0)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannersRight = Cache::rememberForever('bannersRights', function() {
            return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSlider = Cache::rememberForever('bannerUnderSlider', function() {
            return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSale = Cache::rememberForever('bannerUnderSale', function() {
            return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();;
        });


        $deal =  Cache::rememberForever('deal', function() {

            return deal::get();
         });

        $product_sale=  Cache::rememberForever('product_sale', function() {
            return DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get(); 
        });    

       

        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale', 'deal', 'product_sale'));
    }

     

   
}
