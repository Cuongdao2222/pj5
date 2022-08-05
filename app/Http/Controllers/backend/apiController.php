<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class apiController extends Controller
{
    public function updateProduct(Request $request, $slug)
    {
        $product = product::where('ProductSku')->first();

        if(!empty($product)&& !empty($product->id)){

            $id = $product->id;

            $product = product::find($id);

            $product->Price =  $request->Price;

            $product->Quantily = $request->Quantily;

            $result = $product->save();

            if($result){
                return ['result'=>'update thành công'];
            }
            else{
                return ['result'=>'đã xảy ra lỗi trong quá trình update'];
            }

        }
        else{

            return ['result'=>'model sản phẩm không đúng update thất bại'];
        }

    }
}
