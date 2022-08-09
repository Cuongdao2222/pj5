<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\apiUpdate;
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


    public function updateProductApi(Request $request)
    {
        // $data_product = 'UA50AU9000', 'UA50AU8000', 'UA50AU7000';
        // $data_product = explode($data_product, ',');

        // $check = Product::whereIn('ProductSku',  $data_product)->get();
        // if($check->count() != count($data_product)){

        //     return response()->json(['message' => 'Model sản phẩm không đúng, xin kiểm tra lại'], 404);
        // }

        $data = [ ['product'=>'UA50AU9000', 'price'=>5000000, 'qualtity'=>2],  ['product'=>'UA50AU8000', 'price'=>5000001, 'qualtity'=>5]];


        foreach ($data as $key => $value) {

            if()
            
        }

        $product 

        foreach ($data as $key => $value) {
            $update_product = DB::table('products')->update($value);
        }
        echo "update thanh cong";
    }
}
