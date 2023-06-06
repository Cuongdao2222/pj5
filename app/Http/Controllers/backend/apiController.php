<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\apiUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\deal;
use Illuminate\Support\Facades\Redirect;
use DB;


class apiController extends Controller
{
    public function updateProduct(Request $request, $slug)
    {
        $product = product::where('ProductSku', $slug)->first();

        if(!empty($product)&& !empty($product->id)){

            if(!isset($request->Quantily)||!isset($request->Price)){
                 return response()->json([
                'message' => 'param truyền bị lỗi, xin kiểm tra lại'], 404);

            }

            $id = $product->id;

            $product = product::find($id);

            $priceOld = $product->Price;

            $qty_old  = $product->Quantily;

            $product->Price =  $request->Price;

            $product->Quantily = $request->Quantily;

            $result = $product->save();


            $apiUdate = new apiUpdate();

            $apiUdate->model = $slug;

            $apiUdate->qty  = $request->Quantily;

            $apiUdate->price_old = $priceOld;

            $apiUdate->qty_old = $qty_old;

            $apiUdate->price_new = $request->Price;

            $apiUdate->user = $request->User;

            $update_soft = $apiUdate->save();


            if($result && $update_soft){

                return response()->json([
                'message' => 'update sản phẩm thành công!'], 200);
            }
            else{
                return response()->json([
                'message' => 'có lỗi trong quá trình update, xin kiểm tra lại'], 404);
            }

        }
        else{

            return response()->json([
                'message' => 'Model sản phẩm không đúng, xin kiểm tra lại'], 404);
        }

    }

    public function checkDeal()
    {
        return Redirect::to('https://dantri.com.vn/');

    }

    public function updateProductInDay()
    {
        $now     = Carbon::now();
        $product = product::whereDate('updated_at', Carbon::today())->get();

        $data_update = [];

        $i = 0;
        if(!empty($product) && $product->count()>0){
            foreach ($product as $key => $value) {
                $i++;

                $data_update[$i]['product'] =  $value->ProductSku;

                $data_update[$i]['price']   =  $value->Price;
                
            }
        }
        

        $data = json_encode($data_update);

        echo $data;

        die();
    }

    public function updateProductAll(Request $request)
    {
       
        $dataproduct = json_decode($request->getContent());

        $updated = [];
        
        $price_add ='';

        foreach ($dataproduct as $key => $value) {

            if(!empty($value->model)){

                $product = product::select('Price', 'id')->where('ProductSku', trim($value->model))->first();

                if(!empty($product)){

                    $product->Price =   trim(str_replace('.', '', $value->price));

                    $product->save(); 

                    $price_add = $product->Price;

                }
                else{
                    $price_add ='';
                }

            }
            
            //chạy sản phẩm kiểm tra model 

            $updated[$key]['model'] = @trim($value->model);
            $updated[$key]['price'] = $price_add;
          
        }

        return $updated;

    }


    public function checkDealUpdate()
    {
        $now     = Carbon::now();

        $product = deal::where('active',1)->whereDate('updated_at', Carbon::today())->get();

        $data_update = [];

        $i = 0;
        if(!empty($product) && $product->count()>0){
            foreach ($product as $key => $value) {

                if($now->between($value->start, $value->end)){
                    $i++;

                    $data_update[$i]['product'] =   product::find($value->product_id)->ProductSku;

                    $data_update[$i]['price']   =  $value->deal_price;
                }
            }
        }
        

        $data = json_encode($data_update);

        echo $data;

        die();
    }

    public function checkproduct(Request $request)
    {

        $dataproduct = json_decode($request->getContent());

        $update = [];

        foreach ($dataproduct as $key => $value) {

            $product = product::select('ProductSku')->where('ProductSku', trim($value->model))->first();

            if(empty($product)){

                // $check  = DB::table('run_check_model')->where('model', trim($value->model))->first();

                // if(empty($check)){

                //     $insert = DB::table('run_check_model')->insert(['model'=>$value->model]);

                    
                // }
                array_push($update, $value->model);
               
            }

        }

        return response()->json(['data' => $update]);

    }

}
