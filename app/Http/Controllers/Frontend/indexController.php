<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\groupProduct;
use Illuminate\Support\Facades\Cache;
use App\Models\deal;
use App\Models\product;
use Carbon\Carbon;

use Auth;
use DB;



class indexController extends Controller
{
    public function index()
    {
       

        $banners =  Cache::get('baners');

        $deal = Cache::get('deals');

        $group = Cache::get('groups');

       
        $product_sale = Cache::get('product_sale');

         $timeDeal_star = Cache::get('deal_start'); 

        // if(\Request::ip()=='118.70.129.255'&&Auth::check() && Auth::user()->id==4){

        //     $this->cache1();

        //     $banners =  Cache::get('baners');

        //     $deal = Cache::get('deals');

        //     $group = Cache::get('groups');

        //     $timeDeal_star = Cache::get('deal_start'); 
           
        //     $product_sale = Cache::get('product_sale');


        // }

        if(empty($group) ||empty($banners)||empty($product_sale)||empty($deal)){

            $this->cache();

            $banners =  Cache::get('baners');

            $deal = Cache::get('deals');

            $group = Cache::get('groups');

            $timeDeal_star = Cache::get('deal_start'); 

            $product_sale = Cache::get('product_sale');
        }
        


        // $banners = Cache::remember('bannersss',100, function() {
        //     return banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();
        // });

        $bannersRight = Cache::remember('bannersRights',10000, function() {
            return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSlider = Cache::remember('bannerUnderSlider',10000, function() {
            return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
        });

        $bannerUnderSale = Cache::remember('bannerUnderSale',10000, function() {
            return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();;
        });

      
        return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale', 'group','timeDeal_star'));
    }
    public function cache()
    {
       

        $banners = banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();

        $deal = deal::OrderBy('order', 'desc')->get();

        $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();

        $groups = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        $deal_start = $deal->first()->start;

        cache::put('deal_start', $deal_start,10000);

    
        Cache::put('groups', $groups,10000);

        Cache::put('product_sale', $product_sale,10000);
        
        Cache::put('baners',$banners,10000);

        Cache::put('deals',$deal,10000);

    
    }

    public function cache1()
    {
        
        cache::forget('deal_start');

    
        Cache::forget('groups');

        Cache::forget('product_sale');
        
        Cache::forget('baners');

        Cache::forget('deals');


        $banners = banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();

        $deal = deal::OrderBy('order', 'desc')->get();

        $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();

        $groups = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        $deal_start = $deal->first()->start;

        foreach($deal as $value){

            cache::forget('deals'. $value->product_id);

            $deals = product::find($value->product_id);

            Cache::put('deals'.$value->product_id,$deals,10000);

          
            $product_saless = Cache::get('deals'. $value->product_id);
        }

    
        cache::put('deal_start', $deal_start,10000);

        Cache::put('groups', $groups,10000);

        Cache::put('product_sale', $product_sale,10000);
        
        Cache::put('baners',$banners,10000);

        Cache::put('deals',$deal,10000);

        
    }

    public function deleteCache()
    {
        Cache::flush();
        echo "thanh cong";
    }

     
}
