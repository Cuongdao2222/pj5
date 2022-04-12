<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;

class mainController extends Controller
{
    public function findProductByNameOrModel($data)
    {
        $clearData = trim($data);

        $data      = $clearData;

        $resultProduct = Product::select('id', 'Name', 'Price', 'Link', 'Image')->where('Name', $data)->OrWhere('ProductSku', $data)->get();

        return $resultProduct;


    }
}
