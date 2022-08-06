<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\apiUpdate;

class apiController extends Controller
{
    public function updateProduct(Request $request, $slug)
    {
        $product = product::where('ProductSku', $slug)->first();

        if(!empty($product)&& !empty($product->id)){

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

            $apiUdate->save();


            if($result){

                return ['result'=>'update thành công'];
            }
            else{
                return ['result'=>'đã xảy ra lỗi trong quá trình update'];
            }

        }
        else{

            return ['result'=>'model sản phẩm không đúng, update thất bại'];
        }

    }
}
