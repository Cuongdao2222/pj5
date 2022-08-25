<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;

use App\Models\flashdeal;

use DB; 

class flashdealController extends Controller
{
    public function GetProductbyId(request $request)
    {
        $ar_product = json_decode($request->data);

        $edit_id   = $request->edit_id;

       
        $ar_products_id = [];

        foreach($ar_product as $val){

            array_push($ar_products_id, $val->id);
        }
        
        $products   =  product::select('Name', 'Link', 'Price','id', 'Image')->whereIN('id', $ar_products_id)->get()->toArray();

        $products_add = [];

        if(isset($products)){

           for ($i=0; $i < count($products) ; $i++) { 

                $products[$i]['price_deal'] = $ar_product[$i]->price_deal;

                $products_add['name'] = $products[$i]['Name'];
                $products_add['image'] = $products[$i]['Image'];
                $products_add['link'] = $products[$i]['Link'];
                $products_add['price'] = $products[$i]['Price'];
                $products_add['deal_price'] = str_replace([',','.'],'',$products[$i]['price_deal']);

                $products_add['product_id'] = $products[$i]['id'];

                $time = DB::table('deal')->select('start', 'end')->first();

                if(!empty($time)){
                    $products_add['start'] = $time->start;

                    $products_add['end'] = $time->end;
                }  
                else{
                    $products_add['start'] ='';

                     $products_add['end'] ='';

                } 


              
                if(empty($edit_id)){
                     DB::table('deal_flash_product')->insert($products_add);
                }
                else{

                    DB::table('deal_flash_product')->where('id', $edit_id)->update($products_add);
                }
               
           }
        }
        return  $products_add;

    }
    public function dealOrder(Request $request)
    {
        $id = $request->product_id;
        $val = $request->val;
        if(!empty($val)){
            $deal = flashdeal::find($id);
            $deal->order = $val;
            $deal->save();

        }
        return response('thanh cong');
    }
    public function removeDeal(Request $request)
    {
       $id = $request->id;

        DB::table('deal_flash_product')->delete($id);

    }

    public function activeDeal(Request $request){

        $id = $request->id;

        $active = $request->active;

        $deal = flashdeal::find($id);

        if($active == 1){

            $deal->active = 0;

        }
        else{
            $deal->active = 1;
        }

        $deal->save();
    }
}
