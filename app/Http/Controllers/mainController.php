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

       $resultProduct = product::select('id', 'Name', 'Price', 'Link', 'Image')->where('Name','LIKE', '%'. $data .'%')->OrWhere('ProductSku', 'LIKE', '%' . $data . '%')->get();

        return $resultProduct;

    }
    public function ckfinder()
    {
        return view('frontend.ckfinder');
    }

    public function landingpage()
    {
        return view('frontend.landingpage');
    }

    public function sale()
    {
        return view('frontend.sale');
    }

    public function deal()
    {
        return view('frontend.deallist');
    }

    public function lienhe()
    {
        return view('frontend.lienhe');
    }

    public function resultAlepay()
    {
        return view('resultAlepay.result');
    }
    public function filterAdd()
    {
        return view('filter.add-property');
    }

    public function footerpost()
    {
        return view('footerpost.index');
    }

    public function changepass()
    {
        return view('user.changePass');
    }
    public function rate()
    {
        return view('rate.rate');
    }

    public function newBanner()
    {
        return view('newbanner.banner');
    }

    public function funcmorePopup()
    {
        return view('funcmore.popup');
    }
}
