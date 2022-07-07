<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\product;

use App\Models\image;

use App\Models\groupProduct;

use App\Models\filter;
use App\Models\post;

use App\Models\category;

use App\Models\metaSeo;

 use Illuminate\Support\Facades\Cache;


use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Frontend\filterController;


use Session;



class categoryController extends Controller
{


    public function categoryView($slug)
    {


        if(!empty($_GET['filter'])){

            $link     = !empty($_GET['link'])?strip_tags($_GET['link']):'';

            $group_id =  !empty($_GET['group_id'])?strip_tags($_GET['group_id']):'';

            $filter =   !empty($_GET['filter'])?explode(',', $_GET['filter']):'' ;

            $property = !empty($_GET['property'])?explode(',', $_GET['property']):'';


            $new_filter = [];

            $new_property = [];

            if(!empty($filter)){
                foreach($filter as $value){
                    array_push($new_filter, strip_tags($value));
                }
            }

            if(!empty($property)){
                foreach($property as $values){
                    array_push($new_property, strip_tags($values));
                }
            }
             $findID = groupProduct::where('link', $link)->first();

            if(!empty($findID)){

                $id_cate = $findID->id;
                $groupProduct_level = $findID->level;
                $ar_list = $this->find_List_Id_Group($id_cate,$groupProduct_level);

                $parent_cate_id = $ar_list[0]['id'];


                $list_data_group = filter::where('group_product_id', $parent_cate_id)->whereIn('id', $filter)->select('value')->get()->toArray();

                $filter = filter::where('group_product_id', $parent_cate_id)->select('name', 'id')->get();

                $fill = [];

                $keys =  [];

                $result = [];

                $product = [];

                $product_search = [];


                $checkidgroup = groupProduct::find($group_id);

                if(!empty($checkidgroup) && !empty($checkidgroup->product_id)){

                    $checkidgroup_id = json_decode($checkidgroup->product_id);
            
                    if(!empty($list_data_group[0]['value'])){


                        foreach ($list_data_group as $key => $value) {
                            foreach($value as $values){

                                $arr = json_decode($values, true);

                                if(isset($arr)){

                                    array_push($fill, $arr);

                                    $keys[] = array_keys($arr);
                                }
                            }

                        }
                        
                        

                        if(isset($keys)){
                            foreach($keys as $key1 => $vals){

                           
                                foreach($vals as $valu){

                                    if(in_array($valu, $property)){

                                        $result[] = $fill[$key1][$valu];
                                    }
                                
                                }

                            }
                            
                            if(isset($result)){

                                foreach ($result as  $res) {
                                    foreach($res as $res1){
                                        $product[] = $res1;
                                    }
                                }
                            }

                            $number_key = count($keys);

                            $number_product    = array_count_values($product);

                        
                            if(isset($number_product)){
                                $result_product = [];
                                foreach ($number_product as $key => $value) {
                                    if($value == $number_key){
                                        array_push($result_product, $key);
                                    }

                                }

                                $product_search = product::whereIn('id', $result_product)->whereIn('id', $checkidgroup_id)->where('active', 1)->get();
                            }

                        }
                    }

                }
                else{
                     $product_search =[];
                    $id_cate ='';
                    $ar_list =[];
                    $groupProduct_level = 0;

                }
               
            }
            else{
                $product_search =[];
                $id_cate ='';
                $ar_list =[];
                $groupProduct_level = 0;

            }

             return view('frontend.filter', compact('product_search', 'link', 'filter', 'id_cate', 'ar_list', 'groupProduct_level'));

           
             


            

        }
        else{
            $data = $this->getDataOfCate($slug);

            return view('frontend.category', with($data));
        }
       
    }



    public function getDataOfCate($slug)
    {

        $link = trim($slug);

        $findID = groupProduct::where('link', $link)->first();


        if(empty($findID)){
            return $this->blogDetailView($slug);
        }
        else{

            if(!empty($_GET['filter'])){
                $data = new filterController();


                $data = $data->filter();

            }
           
            $id_cate = $findID->id;

            $groupProduct_level = $findID->level;

            $ar_list = $this->find_List_Id_Group($id_cate,$groupProduct_level);

            $parent_cate_id = $ar_list[0]['id'];

            $link   =  $findID->link;

            $Group_product = groupProduct::find($id_cate);

            $slogan =  $Group_product->slogan;

            $meta = metaSeo::find($Group_product->Meta_id);

            $data =[];

            $numberdata = 0;

            if(!empty($Group_product) && !empty($Group_product->product_id)){

                $Group_product_active = $Group_product->active;

                $data = [];

                if($Group_product_active==1){

                    $Group_product = json_decode($Group_product->product_id);

              
                    $data = product::whereIn('id', $Group_product)->where('active', 1)->orderBy('Quantily', 'desc')->paginate(12);

                    $numberdata = product::select('id')->whereIn('id', $Group_product)->where('active', 1)->orderBy('Quantily', 'desc')->get()->count();

                }

            }

            
            $filter = filter::where('group_product_id', $parent_cate_id)->select('name', 'id')->get();

            $data = [
                'data'=>$data,
                'filter'=>$filter,
                'id_cate'=>$id_cate,
                'link'=>$link,
                'ar_list'=>$ar_list,
                'slogan'=>$slogan,
                'meta'=> $meta,
                'numberdata'=>$numberdata,
                'groupProduct_level'=>$groupProduct_level


            ];

            return $data;
        }    

    }    


    protected function find_List_Id_Group($id,  $groupProduct_level)
    {
        $list =  groupProduct::find($id);

        $ar_list = [];

        if(isset($list)){

            if((int)$groupProduct_level>0){

                for ($i=0; $i < $groupProduct_level; $i++) { 

                    $list_add = $list->parent_id;

                    $list =  groupProduct::find($list_add);

                    array_push($ar_list, $list_add);
                   
                    
                }

            }
           
        }

        $ar_list[] = $id;

        $info_list_category = [];

        $groupProduct_info = groupProduct::select('name','link','id')->whereIn('id', $ar_list)->get()->toArray();

        return $groupProduct_info;
    
    }

   

    public function blogDetailView($slug)
    {
        $link = trim($slug);

        $data = post::where('link', $link)->first();

        if(empty($data)){
            return $this->categoriesBlog($slug);

            die();

            
        }

      
        $category = category::find($data->category);


        $related_news = post::where('category', $data->category)->where('active', 1)->select('title', 'link', 'id')->get();

        $name_cate = $category->namecategory;

        $meta = metaSeo::find($data->Meta_id);

        // đếm số lượt view

        $sessionKey = 'post_' . $data->id;

        $sessionView = Session::get($sessionKey);

        $post_view = DB::table('posts')->where('id', $data->id);

        if (!$sessionView) { //nếu chưa có session

            Session::put($sessionKey, 1); //set giá trị cho session

            $post_view->increment('views', 1);

        }

        echo view('frontend.blogdetail',compact( 'name_cate', 'related_news', 'meta', 'data'));

        die();
    }

    public function categoriesBlog($slug)
    {
        $link = trim($slug);

        $datas = category::where('link', $link)->first();

     
        if(empty($datas)){
            abort('404');
        }
        $name_cates_cate = '';
        
        if($datas->id!=5){

             $name_cates_cate = $datas->namecategory;

        }

        $data = post::where('category', $datas->id)->orderBy('date_post','desc')->orderBy('date_post','desc')->paginate(10);

      
        echo view('frontend.blog', compact('data','name_cates_cate'));

        die();



    }


    public function pageView($slug)
    {
        $link = trim($slug);

        $data = post::where('link', $link)->where('category', 5)->first();

        if(empty($data)){
            abort('404');
        }

        $category = category::find(5);


        $related_news = post::where('category', 5)->select('title', 'link', 'id')->get();

        $name_cate = $category->namecategory;

        $meta = metaSeo::find($data->Meta_id);

        return view('frontend.blogdetail',compact( 'name_cate', 'related_news', 'meta', 'data'));

    }
    public function index($slug)
    {
        
       return redirect(route('details', $slug));
    }

    public function details($slug)
    {
        $link = trim($slug);

        $cache = 'findID'.$link;

        $findID = Cache::rememberForever($cache, function() use ($link) {

            return  product::select('id')->where('Link', $link)->first();
        });

       
        // chuyển sang category check

        if(empty($findID)){

            return($this->categoryView($slug));

        }


        else{


            $pageCheck = "product";


        

            if(!Cache::has('dat'.$findID->id) ){

                $image_cache = image::where('product_id', $findID->id)->select('image')->get();

                Cache::put('dat'.$findID->id, $image_cache, 100);

            }

            $images = Cache::get('dat'.$findID->id);



            if(!Cache::has('data-detail'.$findID->id) ){

                $datas = product::findOrFail($findID->id);

                Cache::put('data-detail'.$findID->id, $datas, 100);

            }

            $data = Cache::get('data-detail'.$findID->id);
            
           
            
            if(!empty($data) && !empty($_GET['show'])&&($_GET['show']=='tra-gop')){
                
                return view('frontend.installment', compact('data'));
            }

             $other_product = Cache::remember('other_product', 50, function() use ($data) {
                return  product::where('Group_id',  $data->Group_id)->take(10)->get();
            });


            $meta = Cache::remember('metaseo-detail'.$data->Meta_id,10000, function() use ($data){
                return metaSeo::find($data->Meta_id);
            }); 
            

            // // đếm số lượt view

            // $sessionKey = 'product_' . $findID->id;

            // $sessionView = Session::get($sessionKey);

        
            // if (!$sessionView) { //nếu chưa có session

            //     Session::put($sessionKey, 1); //set giá trị cho session

            //     $post_view = DB::table('products')->where('id', $findID->id)->increment('views', 1);

            // }

            return view('frontend.details', compact('data', 'images', 'other_product', 'meta', 'pageCheck'));
        }
    }

    public function addProductToCart()
    {

        Cart::add(['id' => '294ad', 'name' => 'Smart tivi Samsung UA50AU9000 50 inch 4K', 'qty' => 1, 'price' => '5000.000', 'weight' => '500', 'options' => ['size' => 'large']]);
        $cart =  Cart::content();

    }

}
