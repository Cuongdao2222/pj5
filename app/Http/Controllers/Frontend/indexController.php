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
use Session;

use Auth;
use DB;



class indexController extends Controller
{
    public function index()
    {
       
        $banners =  Cache::get('baners');

        $now  = Carbon::now();

         $deal = Cache::rememberForever('deals', function(){

             $deals = deal::get();

            return $deals;
        });   

      

        $deal = Cache::get('deals')->sortByDesc('order');

        

        // foreach ($deal as $key => $value) {
        //     print($value);

        //     die;
        // }

        $deal_check = Cache::get('deals')->sortByDesc('end');

        $group = Cache::rememberForever('group_index', function(){

            return groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();
        });     

        

        
        $product_sale = Cache::rememberForever('product_sale', function(){

            $product_sales = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->take(20)->get();

            return $product_sales;
        });

        // // thử lấy cache sale 10s 

        // $product_sale = Cache::get('sale_products');

         $timeDeal_star = Cache::get('deal_start'); 

        


        if(!Cache::has('groups')||empty($product_sale) ){

            $this->cache();

            $deal = Cache::get('deals');

            $group = Cache::get('groups');

            $timeDeal_star = Cache::get('deal_start'); 

            $product_sale = Cache::get('product_sale');

        }

        if(!Cache::has('baners')){

            $banners =  Cache::rememberForever('baners', function() {

                return banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();
            });
        }    

        if(!Cache::has('bannersRights')){
            $bannersRight = Cache::rememberForever('bannersRights', function() {
                return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
            });
        }
        else{
            $bannersRight = Cache::get('bannersRights');
        }

        if(!Cache::has('bannerUnderSlider')){

            $bannerUnderSlider = Cache::rememberForever('bannerUnderSlider', function() {
                return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->orderBy('id', 'desc')->first()??'';
            });

        }
        else{
            $bannerUnderSlider = Cache::get('bannerUnderSlider');
        }

        if(!Cache::has('bannerUnderSale')){

            $bannerUnderSale = Cache::rememberForever('bannerUnderSale', function() {
                return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();
            });
        }  
        else{
            $bannerUnderSale = Cache::get('bannerUnderSale');
        }

        $bannerscrollRight = Cache::rememberForever('bannerscrollRight', function() {
            return banners::where('option', 12)->OrderBy('stt', 'asc')->where('active', 1)->first()??'';
        });

        $bannerscrollLeft = Cache::rememberForever('bannerscrollleft', function() {
            return banners::where('option', 13)->OrderBy('stt', 'asc')->where('active', 1)->first()??'';
        });

        $useragent=$_SERVER['HTTP_USER_AGENT']??'';

        $smart_phone = false;

        if(!empty($useragent)){

            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

                $smart_phone = true;

                return view('frontend.index_mb', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale', 'group','timeDeal_star', 'deal_check', 'now','bannerscrollRight', 'bannerscrollLeft'));

            }

        }


        // $view = Cache::rememberForever('view-homes',  function() use($banners, $bannersRight, $bannerUnderSlider,$bannerUnderSale, $deal, $product_sale, $group, $timeDeal_star, $deal_check, $now, $bannerscrollRight, $bannerscrollLeft, $smart_phone){

        //     $view = view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale', 'group','timeDeal_star', 'deal_check', 'now','bannerscrollRight', 'bannerscrollLeft','smart_phone'));

        //      return  html_entity_decode($view);
        // });

        
        // if($smart_phone===false){
        //      echo $view;
        //      die;
        // }
         return view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale', 'group','timeDeal_star', 'deal_check', 'now','bannerscrollRight', 'bannerscrollLeft'));
    

    }


    public function testHome()
    {
        $banners =  Cache::get('baners');

        $now  = Carbon::now();

        if(!Cache::has('deals')){
            $deal = deal::get();

            Cache::forever('deals',$deal);

        }

        $deal = Cache::get('deals')->sortByDesc('order');

        $deal_check = Cache::get('deals')->sortByDesc('end');

        $group = Cache::rememberForever('group_index', function(){

            return groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();
        });     

        
        $product_sale = Cache::rememberForever('product_sale', function(){

              $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->Orderby('products.sale_order','desc')->take(10)->get();

            return $product_sale??'';
        });

         $timeDeal_star = Cache::get('deal_start'); 


        if(!Cache::has('groups')||empty($product_sale) ){

            $this->cache();

            $deal = Cache::get('deals');

            $group = Cache::get('groups');

            $timeDeal_star = Cache::get('deal_start'); 

            $product_sale = Cache::get('product_sale');

        }

        if(!Cache::has('baners')){

            $banners =  Cache::rememberForever('baners', function() {

                return banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();
            });
        }    

        if(!Cache::has('bannersRights')){
            $bannersRight = Cache::rememberForever('bannersRights', function() {
                return banners::where('option', 2)->OrderBy('stt', 'asc')->where('active', 1)->get();
            });
        }
        else{
            $bannersRight = Cache::get('bannersRights');
        }

        if(!Cache::has('bannerUnderSlider')){
            $bannerUnderSlider = Cache::rememberForever('bannerUnderSlider', function() {
                return banners::where('option', 3)->OrderBy('stt', 'asc')->where('active', 1)->get();
            });

        }

        else{
            $bannerUnderSlider = Cache::get('bannerUnderSlider');
        }

        if(!Cache::has('bannerUnderSale')){

            $bannerUnderSale = Cache::rememberForever('bannerUnderSale', function() {
                return banners::where('option', 5)->OrderBy('stt', 'asc')->take(1)->get()->toArray();
            });
        }  
        else{
            $bannerUnderSale = Cache::get('bannerUnderSale');
        }

        $bannerscrollRight = Cache::rememberForever('bannerscrollRight', function() {
            return banners::where('option', 12)->OrderBy('stt', 'asc')->where('active', 1)->first()??'';
        });
        
        $bannerscrollLeft = Cache::rememberForever('bannerscrollleft', function() {
            return banners::where('option', 13)->OrderBy('stt', 'asc')->where('active', 1)->first()??'';
        });


        $view = Cache::rememberForever('view-homes',  function() use($banners, $bannersRight, $bannerUnderSlider,$bannerUnderSale, $deal, $product_sale, $group, $timeDeal_star, $deal_check, $now, $bannerscrollRight, $bannerscrollLeft){

            $view = view('frontend.index', compact('banners', 'bannersRight', 'bannerUnderSlider', 'bannerUnderSale','deal','product_sale', 'group','timeDeal_star', 'deal_check', 'now','bannerscrollRight', 'bannerscrollLeft'));

             return  html_entity_decode($view);
        });

        echo $view;
       
    }

    public function viewLogin(Request $request)
    {

        $ip = $request->ip();

        if($ip ==='118.70.129.255'){
            return view('auth.login');
        }
        else{
            abort(404);
        }
        
    }


    public function cache()
    {
       
        $deal = deal::OrderBy('order', 'desc')->get();

        $groups = groupProduct::select('id','name', 'link', 'active', 'parent_id')->where('parent_id', 0)->get();

        if($deal->count()>0){

            $deal_start = $deal->first()->start;

            cache::put('deal_start', $deal_start,10000);

        }
        Cache::put('groups', $groups,10000);

    }

    public function cache1()
    {
        
        cache::forget('deal_start');

    
        Cache::forget('groups');

        Cache::forget('product_sale');
        
        Cache::forget('baners');

        $banners = banners::where('option','=',0)->take(6)->OrderBy('stt', 'asc')->where('active','=',1)->select('title', 'image', 'title', 'link')->get();

        $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();

        $groups = groupProduct::select('id','name', 'link')->where('parent_id', 0)->get();

        Cache::put('groups', $groups,10000);

        Cache::put('product_sale', $product_sale,10000);
        
        Cache::put('baners',$banners,10000);

        
    }

    public function deleteCache()
    {
        Cache::flush();
        echo "thanh cong";
    }

    public function addClick(Request $request)
    {
        $link = $request->link;

        $sessionKey = 'banner_click_'.$link;

        $sessionView = Session::get($sessionKey);

        $count = Cache::get('visited_banner_'.$link)??0;

        if (!$sessionView) { //nếu chưa có session

            Session::put($sessionKey, 1); //set giá trị cho session

            $count = Cache::increment('visited_banner_'.$link);   

        }

    }

    public function cacheClear()
    {
        Cache::flush();
        file_get_contents('https://dienmaynguoiviet.vn');
        file_get_contents(Route('redirect-update-cache'));
        echo "thanh cong";
    }

    public function removePromotion()
    {
        $data = Product::where('promotion', '<p><span style="color:#000000"><strong><span style="font-size:16px"><span style="font-family:Arial,Helvetica,sans-serif">Tặng C&ocirc;ng Lắp Đặt</span></span></strong></span></p>')->get();

        if(!empty($data) && $data->count()>0){

            foreach ($data as  $value) {

                $product = product::find($value->id);

                $product->promotion = '';

                $product->save();
              
            }

            echo "xóa khuyến mãi của". $data->count().'sản phẩm';
        }
        else{
            echo "không xóa khuyến mãi của sản phẩm nào";
        }
    }



     
}