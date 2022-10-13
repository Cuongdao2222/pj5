<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\hotProduct;

class hotController extends Controller
{
    public function index()
    {
        return view('hot.index');
    }

    public function hotOrderProduct(Request $request)
    {
        $id = $request->product_id;

        $order = $request->val;

        $hot = hotProduct::find($id);

        $hot->orders = $order;

        $hot->save();

    }
}
