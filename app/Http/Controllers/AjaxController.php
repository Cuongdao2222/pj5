<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\hotProduct;

use App\Models\saleProduct;

use App\Models\product;

use App\Models\Order;

use App\Models\filter;

use App\Models\deal;

use App\Models\promotion;

use App\Models\popup;

use Validator;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Gloudemans\Shoppingcart\Facades\Cart;

use DB;
use Illuminate\Support\Facades\Session;
use App\Models\rate;

class AjaxController extends Controller
{
    public function loginClientsFe(Request $request)
    {
        $email =  strip_tags(trim($request->email), '@') ;

       

        $password = $request->password;

        $check  =   DB::table('loginclient')->where('email', $email)->first();

        if(!empty($check)){
            if( Hash::check($request->password, $check->password) == true){

                Session::put('status-login', 'Đăng nhập thành công');

                return redirect()->route('homeFe');

            }

        }

        Session::put('status-login', 'Đăng nhập thất bại, xin kiểm tra lại');
        
        return redirect()->route('homeFe');
        
    }

    public function logout()
    {
        Session::forget('status-login');
        return redirect()->back();

    }
  
    public function addHotProduct(Request $request)
    {

        if($request->ajax())
        {

            $addProduct = new hotProduct();

            $addProduct->product_id = $request->product_id;

            $addProduct->group_id = $request->group_id;

            $addProduct->save();

            return "thêm thành công sản phẩm có product_id ".$request->product_id;

        }
    }

    public function registerClient(Request $request)
    {
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
           'email' => 'required|email|unique:loginClient',
           'fullname' => 'required|string|max:150',
           'password' => 'required'
           ]);
            
           if ($validator->fails()) {

                return response($validator->messages()->first());
                
           }
           else{
                $input['password'] = bcrypt($request->password);
                $input['email'] = strip_tags($request->email);
                $input['fullname'] = strip_tags($request->fullname);
                $result = DB::table('loginClient')->insert($input);
                return response('Đăng ký thành công');

           }
        }    

        
    }

    public function getEmail(Request $request)
    {
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
           'email' => 'required|email|unique:user_email',
           
           ]);
            
           if ($validator->fails()) {

                return response($validator->messages()->first());
                
           }
           else{
                $input['email'] = $request->email;
                
                $result = DB::table('user_email')->insert($input);
                return response('Đăng ký thành công');

           }
        }    

        
    }

    public function removeHotProduct(Request $request)
    {
        $product_id = $request->product_id;

        $product = hotProduct::select('id')->where('product_id', $product_id)->first();

        $id = $product->id;

        if(!empty($id)){

            $product->find($id);
            $product->delete();

            echo "xóa thành công sản phẩm có product_id ".$id;
        }


    }

    public function addSaleProduct(Request $request)
    {

        if($request->ajax())
        {


            $addProduct = new saleProduct();

            $addProduct->product_id = $request->product_id;

            $addProduct->group_id = $request->group_id;

            $addProduct->save();

            return "thêm thành công sản phẩm có product_id ".$request->product_id;

        }
    }

    public function rateForm(Request $request)
    {
        if($request->ajax()){
            $rate =  new rate();
            $input['star'] = $request->star;
            $input['email'] = $request->email;
            $input['name'] = $request->name;
            $input['content'] = $request->content;
            $input['product_id'] = $request->product_id;
            $input['active'] = 0;
            $rate::create($input);

            return response('Đánh giá sản phẩm thành công! đánh giá của bạn đang chờ được kiểm duyệt xin cảm ơn');
           
        }
        
    }

    public function removeSaleProduct(Request $request)
    {
        $product_id = $request->product_id;

        $product = saleProduct::select('id')->where('product_id', $product_id)->first();

        $id = $product->id;

        if(!empty($id)){

            $product->find($id);
            $product->delete();

            echo "xóa thành công sản phẩm có product_id ".$id;
        }


    }

    protected function checkActive(Request $request)
    {
        $id = $request->product_id;

        $active = $request->active;

        $product = product::find($id);

        $product->active = $active;

        $product->save();

        echo "thanh cong";

    }

    public function showViewerProduct(Request $request)
    {
        if($request->ajax()){
            $clear_data = json_decode($request->product_id);


               // kiểm tra dữ liệu đầu vào
            $data_product_id = [];

            if(isset($clear_data)){
                foreach ($clear_data as $value) {
                    $value = strip_tags($value);

                    array_push($data_product_id, $value);

                }
            }
            $product_viewer = product::whereIn('id', $data_product_id)
                  ->Orderby('id')->take(25)->get();

            
            return view('frontend.ajax.viewer-product', compact('product_viewer'));      

        }    
    }

    

    public function addProductToCart(Request $request)
    {
        $id = $request->product_id;

        $data_Product = product::find($id);

        $deal   = deal::where('product_id', $id)->where('active', 1)->get()->first();

        if(!empty($deal)){

            $price = $deal->deal_price;

        }
        else{
            $price = $data_Product->Price;
        }
             
        Cart::add(['id' => $id, 'name' => $data_Product->Name,  'qty' => 1, 'price' => $price, 'weight' => '500', 'options' => ['link' => $data_Product->Link]]);

        $data_cart = Cart::content();

        return view('frontend.ajax.cart', compact('data_cart'));
       
    }

    public function removeProductCart(Request $request)
    {

        $id = $request->product_id;
       
        Cart::remove($id);

        $data_cart = Cart::content();

        return view('frontend.ajax.cart', compact('data_cart'));
    }

    public function showProductCart(Request $request)
    {
        $data_cart = Cart::content();

        return view('frontend.ajax.cart', compact('data_cart'));
    }

    public function addProductToCartByNumber(Request $request)
    {
        $rowId = $request->rowId;

        $qualtity = $request->number;

        Cart::update($rowId, $qualtity);

        $data_cart = Cart::content();

        return view('frontend.ajax.cart', compact('data_cart'));
       
    }

    public function addConfirm(Request $request)
    {
        $id = $request->id;

        $value = $request->value;

        $order = Order::find($id);

        $order->active = $value;

        $order->user_active = Auth::user()->id;

        $order->save();

        return Response('thanh cong');

    }

    public function addValueSelectFilter(Request $request)
    {

        $product_id = $request->product_id;

        $filterId = $request->filter_id;

        $propertyId = $request->property_id;

        $checked  = $request->check;

        $filter   = filter::find($filterId);

        $value   =  $filter->value;

        $arr     = [];


        if(!empty($value)){

            if($checked ==1){

                $arr  = json_decode($value, true);

                if(isset($arr[$propertyId])){

                    $arr[$propertyId][] =   $product_id;
                }
                else{
                    $arr[$propertyId]  = array($product_id);
                }

                
                json_encode($arr);

                $filter->value = $arr;

                $filter->save();

                return response('Thêm thành công');

            }

            // trường hợp xóa 

            else{

                $arr  = json_decode($value, true);

                unset($arr[$propertyId]);

                if(isset($arr[$propertyId])){

                    $index_value = array_search($arr[$propertyId], $product_id);

                    if((int)$index_value>-1){

                        unset($arr[$propertyId][$index_value]);

                        $filter->value = json_encode($arr);

                        $filter->save();

                        return response('xóa thành công');

                    }

                }

            }
            
        }
        // trường hợp chưa có dữ liệu
        else{
            
            
            $arr[$propertyId] = array($product_id);

            $filter->value = json_encode($arr);

            $filter->save();

            return response('thêm thành công');

        }


    }

     protected function filterByValue(Request $request)
    {
        $list_id = json_decode($request->json_id_product);
        $action  = $request->action;

       
        if($action =='id'){
            $product_search   = product::whereIn('id', $list_id)->orderBy('id', 'asc')->get();
        }
        else{
           $product_search   = product::whereIn('id', $list_id)->orderBy('price', $action)->get();
        }
        return view('frontend.ajax.product', compact('product_search', 'action'));
        
    }

    public function accept_rate(Request $request)
    {
        if($request->ajax()){

            $id = $request->id;
            $active =  $request->active;
            $rate =  rate::find($id);
            $rate->active = ($active==1)?0:1;
            $rate->save();

            return response([$id,  $rate->active]);
           
        }
    }

    public function add_group_promotion(Request $request)
    {
        if($request->ajax()){

            $input['end']       = $request->end;

            $input['start']       = $request->start;

            $input['group_name'] = $request->name_promotion;

            $input['gift1'] =$request->gift1;

            $input['gift2'] =$request->gift2;

            if(!empty($request->type)){

                 $input['type'] = 1;
            }
            else{
                $input['type'] = 0;
            }

            $result = DB::table('group_gift')->insert($input);
            
            return response('tạo nhóm gift thành công');

        }    
    }

    public function add_gift(Request $request)
    {
        if($request->ajax()){

            $input['id_product']       = $request->product_id;

            $input['id_group_gift'] = $request->id_group_gift;

            $group_gift = DB::table('group_gift')->where('id', $input['id_group_gift'])->get()->first();


            $input['start'] =  $group_gift->start;

            $input['end'] =  $group_gift->end;


            $result = DB::table('promotion')->insert($input);
            
            return response('thanh cong');

        }    
    }

    public function muchSearch(Request $request)
    {
        if($request->ajax()){

            $input['link']       = $request->link;

            $input['title'] = $request->title;

           

            $result = DB::table('muchsearch')->insert($input);
            
            return response('<a href="'.$request->link.'">'.$request->title.'</a><br>');

        }    
    }

}


