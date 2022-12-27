<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function getInfoOrderToApi()
    {
        
        $postData = [
           'from_date' => '24/12/2022',
           'to_date' => '26/12/2022',
           'page'=>'1',
           'status'=>'CHOGIAOHANG', 
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

        $json =  json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string), true);

        echo "<pre>";

           print_r($json);

        echo "</pre>";

        
    }
}
