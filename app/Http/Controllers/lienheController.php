<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Flash;

use Carbon\Carbon;

use DB;

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
}
