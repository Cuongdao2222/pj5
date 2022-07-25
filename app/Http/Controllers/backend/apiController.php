<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class apiController extends Controller
{
    public function updateProduct(Request $request, $id)
    {

       $product = product::find($id);
        if (empty($product)) {
            return ['result'=>'id sản phẩm không đúng'];
        }
       $product->Name = $request->Name;
       $result = $product->save();

       if($result){
            return ['result'=>'update thành công'];
       }
       else{
            return ['result'=>'đã xảy ra lỗi trong quá trình update'];
       }
    


    }
}
