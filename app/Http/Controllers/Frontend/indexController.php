<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\groupProduct;
use Illuminate\Support\Facades\Cache;
use App\Models\deal;
use DB;



class indexController extends Controller
{
    public function index()
    {
        $minutes = 10;

        $banners =  Cache::get('baners');

        $deal = Cache::get('deals');

       

        // $banners = Cache::remember('bannersss',100, function() {
        //     return banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();
        // });

        $bannersRight = Cache::remember('bannersRights',100, function() {
            return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSlider = Cache::remember('bannerUnderSlider',100, function() {
            return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSale = Cache::remember('bannerUnderSale',100, function() {
            return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();;
        });


      

        $product_sale =  Cache::remember('product_sale',10, function() {

            return DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();
         });

        
      
        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale'));
    }
    public function cache()
    {
        $banners = banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();

        $deal = deal::OrderBy('order', 'desc')->limit(12)->get();
       
        Cache::put('baners',$banners,1000);

        Cache::put('deals',$deal,1000);

        echo "thanh cong";

    }

     

   
}
