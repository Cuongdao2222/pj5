<?php

require(public_path().'/lib_pay/alepay-v3/config.php');

$errorCode = isset($_GET['errorCode']) ? $_GET['errorCode'] : '';
$transactionCode = isset($_GET['transactionCode']) ? $_GET['transactionCode'] : '';
$alepay = new Alepay($config);
$utils = new AlepayUtils();
?>

<link rel="stylesheet" type="text/css" href="https://cdn.tgdd.vn/mwgcart/vue-pro/css/desktop/cart-result.min.2ab80dc527e5d6fd453e.css">
   <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
        <link rel="stylesheet" href="style/style.css">
        <title>Show Data</title>
    </head>
    <body>
        <div id="container">
            <div class="row">
                <div class="col s3"></div>
                <div class="col s6 center">
                    <h3>Kết quả</h3>
                    <ul class="collection col-md-8">
                        <li class="collection-item">
                            <div>



                                <?php 
                                    echo $transactionCode;
                                    echo '<br>Lấy thông tin giao dịch trả góp<br>';
                                    $data = $alepay->Get_Transaction_data($transactionCode);
                                   

                                   
                                ?>
                                <?php if ($errorCode == '000' || $errorCode == '155') {  ?>

                                     

                                    @if($data->message=="Thành công")

                                    <?php  

                                        $data_installment  = App\Models\installment::where('email', $data->buyerEmail)->where('phone', $data->buyerPhone)->get()->first();
                                    ?>
                                    
                                    <section>
                                        <div class="middleCart">
                                            <!---->
                                            <div class="alertsuccess-new"><i class="new-cartnew-success"></i><strong>Đặt hàng thành công</strong></div>
                                            <div class="ordercontent">
                                                <p>Cảm ơn Anh <b>{{ @$data_installment->name }}</b> đã cho Điện Máy Người Việt cơ hội được phục vụ.</p>
                                                <!---->
                                                <div>
                                                    <!---->
                                                    <div class="info-order" style="">
                                                        <div class="info-order-header">
                                                            <h4>Đơn hàng: <span>#{{ $transactionCode }}</span></h4>
                                                            <div class="header-right">
                                                                <a href="/lich-su-mua-hang">Quản lý đơn hàng</a>
                                                                
                                                            </div>
                                                        </div>
                                                        <label>
                                                            <span class="">
                                                                <i class="info-order__dot-icon"></i><span><strong>Người nhận hàng: </strong>{{ @$data_installment->name }}, {{ @$data_installment->phone }}</span><!---->
                                                            </span>
                                                        </label>
                                                        <label>
                                                            <span class="">
                                                                <i class="info-order__dot-icon"></i><span><strong>Giao đến: </strong>{{ @$data_installment->address }}.</span><!---->
                                                            </span>
                                                        </label>
                                                        <label>
                                                            <span class="">
                                                                <i class="info-order__dot-icon"></i><span><strong>Tổng tiền: </strong><b class="red">{{ @$data_installment->price }}₫</b></span><!---->
                                                            </span>
                                                        </label>
                                                        <!----><!----><!----><!---->
                                                    </div>
                                                </div>
                                                <!---->
                                               
                                               
                                               
                                            </div>
                                        </div>
                                    </section>

                                    @endif

                                <?php     
                                } else {
                                    echo "Giao Dịch Thất Bại!";
                                } ?>
                            </div>
                        </li>
                       
                    </ul>
                    <ul class="collection col-md-8">
                        <li class="collection-item">
                            <div>
                                <a href="<?php echo ('http://' . $_SERVER['SERVER_NAME']) ?>">Nhấn Vào Đây Nếu Bạn Muốn Mua Tiếp</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </body>
</html>
