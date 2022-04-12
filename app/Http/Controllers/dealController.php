<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;
use DB;

use App\Models\deal;

class dealController extends Controller
{
    public function index()
    {
        return view('deal.deals');

    }

    public function getProductToGroupId(request $request){

        $groupid = $request->group_id;

        $products = product::select('Name', 'Link', 'Price','id')->where('group_id', $groupid)->where('active', 1)->Orderby('id', 'desc')->paginate(10);
        return view('Frontend.ajax.option_product', compact('products'));

    }


    public function getProductToName(Request  $request)
    {
        $data = $request->data;

        $page = $request->page;

        $datas = new mainController();

        $products = $datas->findProductByNameOrModel($data);

        if($page =='deal'){

            return view('Frontend.ajax.option_product', compact('products'));
        }
        else{
            return view('Frontend.ajax.product_landing', compact('products'));
        }    

    }

    public function GetProductbyId(request $request)
    {
        $ar_product = json_decode($request->data);

        $edit_id   = $request->edit_id;

       
        $ar_products_id = [];

        foreach($ar_product as $val){

            array_push($ar_products_id, $val->id);
        }
        
        $products   =  product::select('Name', 'Link', 'Price','id', 'Image')->whereIN('id', $ar_products_id)->get()->toArray();

        if(isset($products)){

           for ($i=0; $i < count($products) ; $i++) { 

                $products[$i]['price_deal'] = $ar_product[$i]->price_deal;

                $products_add['name'] = $products[$i]['Name'];
                $products_add['image'] = $products[$i]['Image'];
                $products_add['link'] = $products[$i]['Link'];
                $products_add['price'] = $products[$i]['Price'];
                $products_add['deal_price'] = $products[$i]['price_deal'];

                $products_add['product_id'] = $products[$i]['id'];

                if(empty($edit_id)){
                     DB::table('deal')->insert($products_add);
                }
                else{
                    DB::table('deal')->where('id', $edit_id)->update($products_add);
                }
               
           }
        }
        return  $products_add;

    }

    public function add_Deal(Request $request)
    {
        $start = $request->start;

        $end  = $request->end;

        $deal = DB::table('deal')->select('id')->get();


        if(isset($deal)){

            foreach($deal as $value){

                $add_deal = DB::table('deal')->where('id', $value->id);

                $add_deal->update(['start'=>$start, 'end'=>$end]);


            }    
        }


    }

    public function activeDeal(Request $request){

        $id = $request->id;

        $active = $request->active;

        $deal = deal::find($id);

        if($active == 1){

            $deal->active = 0;

        }
        else{
            $deal->active = 1;
        }

        $deal->save();
    }


    public function removeDeal(Request $request)
    {
       $id = $request->id;

        DB::table('deal')->delete($id);

    }
}
