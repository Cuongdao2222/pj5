<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\deal;
use DB;
use Cache;
use App\Models\post;



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

        $deal = Cache::get('deal');

        if(empty($deal)){

            $deals =  deal::select('start','end', 'name', 'price', 'deal_price', 'link')->take(10)->get();

            Cache::put('deal',  $deals, $seconds = 10000);

            $deal = Cache::get('deal');

        }

        $product_sale = Cache::get('product_sale');

        if(empty($product_sale)){

            $product_sales =  DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->take(15)->get();

            Cache::put('product_sale',  $product_sales, $seconds = 10000);

            $product_sale = Cache::get('product_sale');

        }
        $post = Cache::get('post');

        if(empty($post)){

            $posts =post::where('active',1)->where('hight_light', 1)->select('link', 'title', 'image')->take(6)->get()->toArray();

            Cache::put('post',  $posts, $seconds = 10000);

            $post = Cache::get('post');

        }    

        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale', 'deal', 'product_sale', 'post'));
    }
   
}
