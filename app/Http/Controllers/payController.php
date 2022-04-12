<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Alepay;

class payController extends Controller
{

    protected function payAlepay(Request $request)
    {
        require(public_path().'/lib_pay/alepay-v3/config.php');

        $data = $request->all();

        $data['orderDescription'] = 'đơn hàng trả góp';

        $data['currency'] ='VND';

        $data['cancelUrl'] = URL_DEMO;

        $data['amount'] = intval(preg_replace('@\D+@', '', $data['amount']));

        $data['orderCode'] = date('dmY') . '_' . uniqid();

        $data['currency'] = 'VND';

        $data['totalItem'] = intval($data['totalItem']);

        $data['customMerchantId'] = trim($data['buyerName']);

        $data['checkoutType'] = 2;

        $data['allowDomestic'] = false;

        $data['installment'] = false; 

        $data['paymentHours'] = 48;

        $data['buyerPhone'] = trim($data['phoneNumber']);

        $data['buyerCountry'] = 'Việt Nam';

        $result = new Alepay($config);

        $result = $result->sendOrderV3($data);
        
        
        if (!empty($result->code)) {
            if ($result->code == '000') {
                echo '<meta http-equiv="refresh" content="0;url=' . $result->checkoutUrl . '">';
            } else {
                echo '<p style="text-align: center; margin-top: 15px;"><b>Response:</b> ' . json_encode($result, JSON_UNESCAPED_UNICODE) . '</p>';
            }
        }

    }
}
