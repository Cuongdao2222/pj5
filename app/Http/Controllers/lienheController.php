<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Flash;

use Carbon\Carbon;

use DB;

use App\Models\call;

class lienheController extends Controller
{
    public function addLienhe(Request $request)
    {
       
        $data = $request->all();
        unset($data['_token']);
         unset($data['return_url']);
         unset($data['action']);
        $data['created_at'] = Carbon::now();
        DB::table('lienhe')->insert($data);
        Flash::success('gửi liên hệ thành công');

        return redirect()->back();


    }

    public function callphone(Request $request)
    {   
        if(!empty($request->name) && !empty($request->phone)){
            $callphone = new call();
            $callphone->name  = strip_tags($request->name);
            $callphone->phone = strip_tags($request->phone);
            $callphone->save();

        }
       
    }
}
