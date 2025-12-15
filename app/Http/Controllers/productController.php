<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Repositories\productRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\groupProduct;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\hotProduct;
use Flash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Storage;

use  App\Http\Controllers\Frontend\categoryController;

use Illuminate\Support\Facades\Cache;
use App\Models\searchkey;
use Response;
use App\Models\historyPd;
use DB;
use Cookie;

use App\Models\metaSeo ;

class productController extends AppBaseController
{
    /** @var  productRepository */
    private $productRepository;

    public function __construct(productRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $show_pd_promotion_money = $_GET['promotion_money']??'';

        $products = product::Orderby('updated_at', 'desc')->paginate(10);

        if(!empty($show_pd_promotion_money)){

            if(Cache::has('money_promotion')){

                $product_id_ar = collect(Cache::get('money_promotion'));

                $products = product::whereIn('id', $product_id_ar)->paginate(10);

            }

        }
        

        if(!empty($_GET['promotion'])){
            $products = product::Orderby('updated_at', 'desc')->where('promotion','!=', '')->paginate(20);
        }
        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    public function promotionCheckDefault(Request $request)
    {
       
        $value = $request->value;

        $product_id = $request->product_id;


        DB::table('products')->where('id', $product_id)->update(['promotion_box'=>$value]);

        return $value;

    }

    public function check_error_api($url)
    {
       $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/x-www-form-urlencoded",
            "token: eecc19a1cabb51a5080f6f56399f7e82"
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new \Exception("❌ Lỗi cURL: " . $error);
        }

        if ($http_code == 500) {
            throw new \Exception("❌ API lỗi 500: Internal Server Error");
        } elseif ($http_code == 403) {
            throw new \Exception("🚫 API lỗi 403: Không có quyền truy cập!");
        } elseif ($http_code == 404) {
            throw new \Exception("🔍 API lỗi 404: Không tìm thấy API!");
        }

        $data = json_decode($response, true);
        if ($data === null) {
            throw new \Exception("⚠️ Lỗi JSON: Không thể parse dữ liệu!");
        }

        return $data;
    }

    public function update_price_sheet_data()
    {
        $context = stream_context_create(array(
            'http' => array(
                
                'method' => 'GET',

                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "token: eecc19a1cabb51a5080f6f56399f7e82",
                
            )
        ));

        $link_api ='https://api.dienmaynguoiviet.net/api/show-price-sheet-data';
            
        $response = $this->check_error_api($link_api);

      

        if(!empty($response['values'])){

          
             return view('products.update_price_sheet', compact('response'));
        }
        else{
            echo "Xin vui lòng thử f5 lại sau 1 phút";
            die;
        }    
        // }
        // $response = json_decode(file_get_contents($link_api, FALSE, $context));

        // // return view('products.update_price_sheet', compact('response'));

        // dd($response);

    }

    public function update_quantity_sheet_data()
    {
        $context = stream_context_create(array(
            'http' => array(
                
                'method' => 'GET',

                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "token: eecc19a1cabb51a5080f6f56399f7e82",
                
            )
        ));

        $link_api ='https://api.dienmaynguoiviet.net/api/show-quantity-sheet-data';
            
        $response = $this->check_error_api($link_api);

        if(!empty($response['values'])){

          
             return view('products.update_quantity', compact('response'));
        }
        else{
            echo "Xin vui lòng thử f5 lại sau 1 phút";
            die;
        }   

    }

    public function update_sheet_data_post()
    {
        $context = stream_context_create(array(
            'http' => array(
                
                'method' => 'GET',

                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "token: eecc19a1cabb51a5080f6f56399f7e82",
                
            )
        ));

        $link_api ='https://api.dienmaynguoiviet.net/api/show-price-sheet-data';

        $response = json_decode(file_get_contents($link_api, FALSE, $context));


        if(!empty($response->values)){

            foreach($response->values as $val){

                $product = DB::table('products')->select('Price', 'id', 'ProductSku')->where('ProductSku', $val[0])->first();

                if(!empty($product)){

                    $products_history   = new historyPd();
                    $products_history->product_id = $product->id;
                    $products_history->user_id = Auth::user()->id;

                    $products_history->price_old =  $product->Price;

                    $products_history->save();

                    $update = product::find($product->id);
                    $update->price = str_replace('.', '', $val[1]);
                    $update->save();
                }

            }
        }

        return redirect()->back();
    }

    public function showDataAjaxUpdateToSheet(Request $request)
    {

         $context = stream_context_create(array(
            'http' => array(
                
                'method' => 'GET',

                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "token: eecc19a1cabb51a5080f6f56399f7e82",
                
            )
        ));

        $link_api ='https://api.dienmaynguoiviet.net/api/show-price-sheet-data';

        $response = json_decode(file_get_contents($link_api, FALSE, $context));

        $data = $response->values;

        if(!empty($data)){
            foreach ($data as $key => $value) {
            
                $product = DB::table('products')->select('Price', 'id', 'ProductSku')->where('ProductSku', $value[0])->first();
                $price_new = str_replace('.', '', $value[1]);
                if(!empty($product)){
                    $products_history   = new historyPd();
                    $products_history->product_id = $product->id;
                    $products_history->user_id = Auth::user()->id;

                    $products_history->price_old =  $product->Price;

                    $price_repair = str_replace('.', '', $price_new);

                    if(intval($products_history->price_old)!= intval($price_repair)){
                        $products_history->save();
                        $update = product::find($product->id);
                        $update->price = str_replace('.', '', $price_new);
                        $update->save();
                        Cache::forget('data-detail'.$update->Link);
                    }

                }

            }

        }
        Cache::forget('product_search');
        $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku', 'manuPrice', 'orders_hot', 'Salient_Features')->where('active', 1)->get();
                    Cache::forever('product_search',$productss);

    }

    /**
     * Store a newly created product in storage.
     *
     * @param CreateproductRequest $request
     *
     * @return Response
     */
    public function store(CreateproductRequest $request)
    {
        $input = $request->all();


        if(empty($input['Link'])){

            $input['Link'] =  str_replace('/', '', convertSlug($input['Name']));
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $input['Price']);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }


        if(!empty($input['InputPrice'])){

            $input['InputPrice'] = str_replace(',', '', $input['InputPrice']);
            $input['InputPrice'] = str_replace('.', '', $input['InputPrice']);
        }

        if(!empty($input['manuPrice'])){

            $input['manuPrice'] = str_replace(',', '', $input['manuPrice']);
            $input['manuPrice'] = str_replace('.', '', $input['manuPrice']);
        }

        if(!empty($input['GiftPrice'])){

            $input['GiftPrice'] = str_replace(',', '', $input['GiftPrice']);
            $input['GiftPrice'] = str_replace('.', '', $input['GiftPrice']);
        }

        if(empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    

        

        if(!empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    

        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'ftp');

            Storage::disk('ftp')->put($filePath, fopen($file_upload, 'r+'));
      
            $input['Image'] = $filePath;
        }

        //add meta seo cho product

        $meta_title = $input['ProductSku'].', '.$input['Name'].' giá rẻ, Trả góp 0%';

        $meta_content = 'Mua '.$input['Name'].' giá rẻ. Miễn phí giao hàng & Lắp đặt. Đổi lỗi trong 7 ngày đầu. Liên hệ  hotline để mua hàng'; 

        $meta_model = new metaSeo();

        $meta_model->meta_title =$meta_title;

        $meta_model->meta_content =$meta_content;

        $meta_model->meta_og_content =$meta_content;

        $meta_model->meta_og_title =$meta_title;

        $meta_model->meta_key_words =$meta_title;

        $meta_model->save();

        $input['Meta_id'] = $meta_model['id'];

        $input['user_id'] =  Auth::user()->id;

        

        $product = $this->productRepository->create($input);

        return redirect()->route('group-product-selected', $product['id']);
        
        // return Redirect()->back()->with('id', $product['id']);

    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }


    public function newCrawl()
    {
        $products = product::where('user_id', 1)->where('Name', NULL)->where('Image', NULL)->Orderby('updated_at', 'desc')->paginate(10);
        
        return view('products.index')
            ->with('products', $products);
    }



    /**
     * Show the form for editing the specified product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.edit')->with('product', $product);
    }


    /**
     * Update the specified product in storage.
     *
     * @param int $id
     * @param UpdateproductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductRequest $request)
    {
        $product = $this->productRepository->find($id);

        $input  = $request->all();


        if(empty($product->Link)){

            $input['Link'] = convertSlug($input['Name']);
        }



        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $request->Price);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }


        if(Auth::user()->id==4 || Auth::user()->id==6){
            if(!empty($input['InputPrice'])){

                $input['InputPrice'] = str_replace(',', '', $input['InputPrice']);
                $input['InputPrice'] = str_replace('.', '', $input['InputPrice']);
            }
        }
        if(!empty($input['manuPrice'])){

            $input['manuPrice'] = str_replace(',', '', $input['manuPrice']);
            $input['manuPrice'] = str_replace('.', '', $input['manuPrice']);
        }

        if(!empty($input['GiftPrice'])){

            $input['GiftPrice'] = str_replace(',', '', $input['GiftPrice']);
            $input['GiftPrice'] = str_replace('.', '', $input['GiftPrice']);
        }
            

        if(!empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    


        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'public');

            $input['Image'] = $filePath;
        }

        $input['user_id'] =  Auth::user()->id;

        if(!empty($input['Price'])){
             if($product->Price != $input['Price']){

                $products_history   = new historyPd();
                $products_history->product_id = $product->id;
                $products_history->user_id = Auth::user()->id;

                $products_history->price_old =  $product->Price;

                $products_history->save();

            }

            // file_get_contents("https://api.dienmaynguoiviet.net/public/test-api?product_sku=".$product->ProductSku."&price=".$input['Price']."&string=AtBSvrztfw5hXwxZeIf0fWf3GtuILFeCOBsRtnah");

        }
         
        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect()->back();
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    public function product_sale_show(Request $request)
    {
        $choose = $request->choose;
        if($choose==0){

            
            $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->take(5)->orderBy('sale_order', 'desc')->get();

            // tạm ẩn khuyến mãi theo nhóm

            $data = DB::table('group_product')->where('id', 333)->first();

            $data_convert = json_decode($data->product_id);

            $product_sale = product::whereIn('id', $data_convert)->orderBy('id', 'desc')->get();
        
        }
        else{
            $hot = DB::table('hot_product')->take(5)->get()->pluck('product_id');

            $product_sale = product::whereIn('id', $hot->toArray())->where('active', 1)->orderBy('sale_order', 'desc')->get();

        }
        return view('frontend.product_sale', compact('product_sale'));
    }

    public function product_sale_show_mobile(Request $request)
    {
        $choose = $request->choose;
        if($choose==1){

            $product_sale = DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->take(20)->orderBy('sale_order', 'desc')->get();

            
        }
        else{
            $hot = DB::table('hot_product')->take(20)->get()->pluck('product_id');

            $product_sale = product::whereIn('id', $hot->toArray())->where('active', 1)->orderBy('sale_order', 'desc')->get();

        }
        return view('frontend.product_sale_mobile', compact('product_sale'));
    }





    public function FindbyNameOrModel(Request $request)
    {
        $clearData = trim($request->search);

        $data      = strip_tags($clearData);

        $data = strtoupper($data);

        $resultProduct = [];

        $find_first = Product::select('id')->where('Name','LIKE', '%'. $data .'%')->OrWhere('ProductSku', 'LIKE', '%' . $data . '%')->OrderBy('id', 'desc')->get()->pluck('id');

    
        if(isset($find_first)){

            foreach ($find_first as  $value) {

                array_push($resultProduct, $find_first);
            }


        }

        
        if(isset($resultProduct)){

            $products = Product::whereIn('id', $resultProduct)->paginate(40);

            return view('products.index')
            ->with('products', $products);

        }
        else{
           Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');

            return redirect(route('products.index'));
        }
            
        
    }

    public function selectProductByCategory($cate_id)
    {
       // $products = Product::where('Group_id', $cate_id)->orderBy('id', 'desc')->paginate(10);

        $Group_product = groupProduct::find($cate_id);


        $Group_product = json_decode($Group_product->product_id);


        $products = Product::whereIn('id', $Group_product)->orderBy('id', 'desc')->paginate(10);


        return view('products.index')
            ->with('products', $products);

        if (empty($product)) {

            Flash::error('Product not found');

            return redirect(route('products.index'));
        }


    }

    public function editFastPrice(Request $request)
    {
        $price = $request->price;

        $price = str_replace(',', '', $price);

        $price = str_replace('.', '', $price);

        $product_id = $request->product_id;

        $product = product::find($product_id);

        $price_old = $product->Price;


        $product->Price = $price;

        // file_get_contents("https://api.dienmaynguoiviet.net/public/test-api?product_sku=".$product->ProductSku."&price=".$price."&string=AtBSvrztfw5hXwxZeIf0fWf3GtuILFeCOBsRtnah");

        $product->user_id = Auth::user()->id;

        $products_history   = new historyPd();
        $products_history->product_id = $product_id;
        $products_history->user_id = Auth::user()->id;

        $products_history->price_old =  $price_old;

        $products_history->save();

    

        $product->save();
        return response('thanh cong');

    }

    public function getPDviewer(Request $request)
    {
        $datas = json_decode($request->viewerPD);

        if(!empty($datas) && count($datas)>0){

            $product_data = product::select('Image', 'Name', 'id', 'Link')->whereIn('id',$datas)->take(3)->get();

            return view('frontend.ajax.viewer-compare-product',compact('product_data'));

        }

    }

     public function editFastQualtity(Request $request)
    {

        $qualtity = $request->qualtity;
        $product_id = $request->product_id;
        $product = product::find($product_id);
        $product->Quantily = $qualtity;
        $product->user_id = Auth::user()->id;

        $product->save();
        return response('thanh cong');

    }

    public function editSaleOrder(Request $request)
    {

        $sale_order = $request->sale_order;
        $product_id = $request->product_id;
        $product = product::find($product_id);
        $product->sale_order = $sale_order;
       

        $product->save();
        return response('thanh cong');

    }

    public function FindbyNameOrModelOfFrontend(Request $request)
    {
        $clearData = trim($request->key);

        $clearData = strip_tags($clearData);

        $search = $clearData;

        $ip = $_SERVER['REMOTE_ADDR'];

        if($ip =='117.7.215.120'){

            dd(1);

            die;

        }

        if($search === 'oled'){
            $search = 'tivi oled';
        }

        if(!empty($search)){



            $search = str_replace('dieu hoa', 'Điều hòa', $search);

            $search = str_replace('tu dong', 'Tủ đông', $search);

            $search = ucfirst($search);


            if(!Cache::has('product_search')){

                $productss = product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku', 'promotion_box')->where('active', 1)->get();

                Cache::forever('product_search',$productss);

            }

            $data =  Cache::get('product_search');


            $resultProduct = [];

            $numberdata = 0;

            $product = collect($data)->filter(function ($item) use ($search) {
                //check loi empty ProductSku
                if(empty($search)){
                   return false;
                }
                return false !== strpos($item->ProductSku, $search);
            });

            if($product->count()==0){

                $product = collect($data)->filter(function ($item) use ($search) {

                    if(empty($search)){

                       return false;
                    }
                    return false !== strpos($item->Name, $search);
                   
                });

                // search khi tên có viết hoa

                if($product->count()==0){

                    if(empty($search)){

                       return false;
                    }

                    $product = collect($data)->filter(function ($item) use ($search) {
                        return false !== stristr($item->Name, $search);
                    });


                    if($product->count()==0){

                        // nếu không có thì search bằng thư viện FullTextSearch

                        if($product->count()==0){
                            // search bằng thư viện FullTextSearch
                            $product = product::FullTextSearch('Name', $search)->select('id', 'Name', 'Price', 'Link', 'Image')->where('active', 1)->orderBy('Quantily', 'desc')->get();
                            
                            if($product->count()==0){
                                $product = product::where('Name', 'like', '%'.$search.'%')->where('active', 1)->orderBy('Quantily', 'desc')->get();
                            }
                        } 
                       
                    }
                }
            }

            $find_first = $product->take(50)->sortByDesc('id')->pluck('id');

            if(isset($find_first)){

                 $numberdata = count($find_first);

                foreach ($find_first as  $value) {

                    array_push($resultProduct, $find_first);
                }

            }

            $page_search = 'filterFe';

           
            if(isset($resultProduct) && !empty($resultProduct[0])){

                $resultProduct = $resultProduct[0]->toArray();

                $data = Cache::get('product_search')->whereIn('id', $resultProduct)->forPage(1, 50);

                

                

                return view('frontend.category',compact('data','numberdata','page_search'));
            }
            else{
                $data = [];


                return view('frontend.category', compact('data', 'numberdata', 'page_search'));

                
                

                
                // Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');
            }

        }


    }

    public function searchPdCompare(Request $request)
    {

        $clearData = trim($request->search);

        $clearData = strip_tags($clearData);

        $search = $clearData;

        $product = product::where('Name', 'like', '%'.$search.'%')->where('active', 1)->Orwhere('ProductSku', $search)->where('active', 1)->first();
        

        return $product;
    }

    public function filterProduct(Request $request)
    {
        $ar_pd = json_decode($request->ar_product_id);

        // $ar_pd = [4573,4673,4636];

        $ar_gr = [];

        if(isset($ar_pd)){

            foreach ($ar_pd as $key => $value) {
               $gr =  new categoryController();
               $gr_id = $gr->get_Group_Product($value);

               array_push($ar_gr, $gr_id[0]);
            }
        }
        $unique = array_unique($ar_gr);

       
        if(count($unique)==1){
            return $unique[0];
        }
        return 0;
    }

    public function imagecontent($id)
    {
        return view('products.image', compact('id'));
    }

    public function sosanh()
    {
        $data = $_GET['list']??'';
       

        if(empty($data)){
            return abort('404');
        }
        else{
            $data = explode(',', $data);
            if(!isset($data)||count($data)>4){
                return abort('404');
            }
        }
        return view('frontend.sosanh', compact('data'));
        
    }


    public function search(Request $request)
    {

        $value2 = $request->cookie('test-cookie-2');
        dd($value2);

        // return abort('404');
        
    }

    public function viewHistoryPD($id)
    {
        $data = historyPd::where('product_id', $id)->OrderBy('id', 'desc')->take(6)->get();

        if($data->count()>0){
            return  view('products.history', compact('data'));
        }
        else{
            return abort('404');
        }

    }

    public function showDataForGroupProduct(Request $request)
    {
        $data = $request->data;
        $data = json_decode($data);

        $data_product = Product::select('Name', 'Price', 'Link')->whereIn('id', $data)->get();

        $name = [];

        $price = [];

        $link  = [];

        if($data_product->count()>0){
            foreach ($data_product as $value) {

                array_push($name, $value->Name);

                array_push($price, $value->Price);

                array_push($link, $value->Link);
            }
        }


        $data_view = json_encode([$name, $price, $link]);

        return response($data_view);

        
    }

    
}
