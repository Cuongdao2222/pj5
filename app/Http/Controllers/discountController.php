<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class discountController extends Controller
{
    public function index()
    {
        return view('discount.index');
    }

    public function store(Request $request)
    {
       
        $quantity = $request->quantity;

        $price = trim($request->price);

        DB::table('discount')->insert(['code'=>'DMNV_'.substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 10), 'quantity'=>$quantity, 'price'=> str_replace('.', '', $price) ]);
          
        return redirect()->back();
        
    }

    public function addDiscount(Request $request)
    {
        $discount = trim($request->discount);

        $discount = strip_tags($discount);

        $discount = DB::table('discount')->select('price', 'used', 'quantity')->where('code', $discount)->first();

        if(!empty($discount) && $discount->quantity >$discount->used){

            return $discount->price;

        }
        return 0;

    }
}
