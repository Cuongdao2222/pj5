<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class apiController extends Controller
{
    public function seedDB()
    {
        DB::table('api_user')->insert([
            'name' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'adminApi@gmail.com',
            'api_token' => API_TOKEN_ADMIN,
        ]);

        echo "thanh cong";
    }

    public function getInfoOrderToApi($status)
    {
        
        $postData = [
           'from_date' => '29/12/2022',
           'to_date' => '29/12/2022',
           'page'=>'1',
           'status'=>$status, 
        ];
        $context = stream_context_create(array(
            'http' => array(
                
                'method' => 'POST',

                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "Authorization: Basic Z2VuY3JtX2drczpnZW5jcm1fZ2tzQDIwMTYj",
                'content' => json_encode($postData)
            )
        ));

        // Send the request
        $response = file_get_contents('https://dienmaynguoiviet.gencrm.com/modules/api/contract/filter', FALSE, $context);

        // Check for errors
        if($response === FALSE){
            die('Error');
        }

        // Decode the response
     
        $string = str_replace('\n', '', $response);

        $string = rtrim($string, ',');

        $string = "[" . trim($string) . "]";

        $result =  json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string), true);

        return $result;

        
    }

    public function filterOrderToNumberPhoneStatus($status, $number_phone)
    {
        $data = $this->getInfoOrderToApi($status);

        $info_data = $data[0]['data']['data']??'';

        if(isset($info_data)){

            $ar_val = [];
            foreach ($info_data as $key => $value) {

                $datas = array($value['dien_thoai']);

                if(strpos($value['dien_thoai'], ',')){

                    $datas = explode(',', $value['dien_thoai']);
                }

                array_push($ar_val, $datas);
                
            }

            foreach ($ar_val as $key => $value) {

                if(in_array($number_phone, $value)){

                    return($info_data[$key]);

                }

                
            }  
            return $info_data;

        }
    }

    public function searchInfoOrder()
    {
        $ar_status = ['CHOGIAOHANG','HOAN','KT','HUY'];

        $data = [];

        foreach ($ar_status as $key => $value) {

            if($this->filterOrderToNumberPhoneStatus($value, '0934234388')!=''){

                $data = $this->filterOrderToNumberPhoneStatus('CHOGIAOHANG', '0934234388');

                dd($data);

                die();
            }

        }

        $data = $this->getInfoOrderToApi('CHOGIAOHANG');
       

    }

    public function updateQuatityToSheet(Request $request)
    {
        
        $context = stream_context_create(array(
            'http' => array(
                
                'method' => 'GET',

                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "token: eecc19a1cabb51a5080f6f56399f7e82",
            )
        ));

        // Send the request
        $response = file_get_contents('http://localhost:8000/api/show-product-qualtity', FALSE, $context);

        $data = json_decode($response);

        if(count($data)>0){

            foreach($data as $val){

                // kiểm tra sản phẩm có tồn lớn hơn 0;

                if(intval($val->qualtity)>0){

                    // kiểm tra xem model có tồn tại trong db nếu tồn tại thì update số lượng là 10sp

                    $check_model = DB::table('products')->where('ProductSku', $val->model)->first();

                    if(!empty($check_model)){

                        $insert = ['name'=>$check_model->ProductSku, 'qty'=>$val->qualtity, 'product_id'=>$check_model->id];

                        DB::table('qualtity1')->insert($insert);

                        DB::table('products')->where('ProductSku', $val->model)->update(['Quantily'=>10]);

                    }

                }

            }
        }

        echo "thành công";
    }
}   
