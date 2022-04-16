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
                                    print_r($alepay->getTransactionInfo($transactionCode));

                                    die();
                                ?>
                                <?php if ($errorCode == '000' || $errorCode == '155') {  ?>
                                    <section>
                                        <div class="middleCart">
                                            <!---->
                                            <div class="alertsuccess-new"><i class="new-cartnew-success"></i><strong>Đặt hàng thành công</strong></div>
                                            <div class="ordercontent">
                                                <p>Cảm ơn Anh <b>Anh Đặt thử</b> đã cho Điện Máy Người Việt cơ hội được phục vụ.</p>
                                                <!---->
                                                <div>
                                                    <!---->
                                                    <div class="info-order" style="">
                                                        <div class="info-order-header">
                                                            <h4>Đơn hàng: <span>#56035442</span></h4>
                                                            <div class="header-right">
                                                                <a href="/lich-su-mua-hang">Quản lý đơn hàng</a>
                                                                <div class="cancel-order-new">
                                                                    <div>
                                                                        <div class="cancel-order-new"><span style="margin: 0px 8px;">•</span><a href="javascript:;">Hủy</a></div>
                                                                    </div>
                                                                    <span class="cancel-order-popup" style="display: none;">
                                                                        <span class="helper"></span>
                                                                        <div class="cancel-order-popup__content">
                                                                            <h1>Hủy đơn hàng</h1>
                                                                            <p>Dienmayxanh.com mong nhận được sự góp ý của anh để phục vụ được tốt hơn.</p>
                                                                            <!--fragment#6abf352fff#head-->
                                                                            <p fragment="6abf352fff" class="cancel-order-popup__content__reason">
                                                                                <span class="cancel-order-popup__content__reason__item">
                                                                                    <span class=""><i class="cartnew-choose"></i> Đổi ý, không mua nữa </span><!---->
                                                                                </span>
                                                                                <span class="cancel-order-popup__content__reason__item">
                                                                                    <span class=""><i class="cartnew-choose"></i> Tìm thấy giá rẻ hơn ở chỗ khác </span><!---->
                                                                                </span>
                                                                                <span class="cancel-order-popup__content__reason__item">
                                                                                    <span class=""><i class="cartnew-choose"></i> Muốn thay đổi sản phẩm trong đơn hàng (màu sắc, số lượng,...) </span><!---->
                                                                                </span>
                                                                                <span class="cancel-order-popup__content__reason__item">
                                                                                    <span class=""><i class="cartnew-choose"></i> Lý do khác </span><!---->
                                                                                </span>
                                                                            </p>
                                                                            <!--fragment#60e88f4ac1#head--><input fragment="60e88f4ac1" type="hidden"><label fragment="60e88f4ac1" class="error cancel-order-popup__content__error"></label><!--fragment#60e88f4ac1#tail--><!--fragment#6abf352fff#tail-->
                                                                            <p class="cancel-order-popup__content__actions"><button class="cancel-order-popup__content__actions__button cart-result-fl confirm-cancel-popup">Đóng</button><button class="cancel-order-popup__content__actions__button cart-result-fr close-cancel-popup">Xác nhận</button></p>
                                                                            <p class="cancel-order-popup__content__note"> Lưu ý: <br> - Quà khuyến mãi có thể thay đổi theo thời điểm đặt hàng. </p>
                                                                        </div>
                                                                    </span>
                                                                    <div class="success-popup" style="display: none;">
                                                                        <span class="helper"></span>
                                                                        <div>
                                                                            <h1>Hủy đơn hàng thành công</h1>
                                                                            <p>Đơn hàng đã được hủy thành công.</p>
                                                                            <button class="success-cencell-popup">Đóng</button>
                                                                            <p class="conut-success"> Tự động đóng trong <b>5</b> giây </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label>
                                                            <span class="">
                                                                <i class="info-order__dot-icon"></i><span><strong>Người nhận hàng: </strong>Anh Đặt thử, 0987654321</span><!---->
                                                            </span>
                                                        </label>
                                                        <label>
                                                            <span class="">
                                                                <i class="info-order__dot-icon"></i><span><strong>Giao đến: </strong>Anh tôi đặt thử thôi.</span><!---->
                                                            </span>
                                                        </label>
                                                        <label>
                                                            <span class="">
                                                                <i class="info-order__dot-icon"></i><span><strong>Tổng tiền: </strong><b class="red">1.402.000₫</b></span><!---->
                                                            </span>
                                                        </label>
                                                        <!----><!----><!----><!---->
                                                    </div>
                                                </div>
                                                <!---->
                                                <div>
                                                    <!---->
                                                    <h4 class="order-infor-alert"> Đơn hàng chưa được thanh toán </h4>
                                                </div>
                                                
                                               
                                                <div class="timetakegoods">
                                                    <h4>Thời gian nhận hàng</h4>
                                                    <div class="box-order">
                                                        <!----><!--fragment#178842422f1#head-->
                                                        <div fragment="178842422f1" class="rowtime"><span>Giao trước 19h00 Thứ Bảy (23/04)</span></div>
                                                        <!----><!--fragment#178842422f1#tail-->
                                                        <ul>
                                                            <li>
                                                                <a href="/lo-vi-song/sharp-r-g620vn" target="_blank" class="img-order"><img data-src="https://cdn.tgdd.vn/Products/Images/1987/72215/sharp-r-g620vn-72215-200x200.png" src="https://cdn.tgdd.vn/Products/Images/1987/72215/sharp-r-g620vn-72215-200x200.png" loading="lazy" class=" ls-is-cached lazyloaded"></a>
                                                                <div class="text-order">
                                                                    <a href="/lo-vi-song/sharp-r-g620vn" target="_blank" class="text-order__product-name">Lò vi sóng có nướng Sharp R-G620 VN (ST) 20 lít</a>
                                                                    <div class="amount-color">
                                                                        <small>Màu: <small>Inox</small></small><!----><small>Số lượng: <small>1</small></small>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!--fragment#d16d94e98a#head-->
                                                        <div fragment="d16d94e98a" class="lastrow">
                                                            <!---->
                                                        </div>
                                                        <!----><!--fragment#d16d94e98a#tail-->
                                                    </div>
                                                    <!----><!----><a href="https://www.dienmayxanh.com" class="buyanotherNew"> Mua thêm sản phẩm khác </a>
                                                </div>
                                                <span class="customer-rating">
                                                    <div class="customer-rating__top">
                                                        <div class="customer-rating__top__desc"> Anh Đào Văn Cường có hài lòng về trải nghiệm mua hàng? </div>
                                                        <div class="customer-rating__top__rating-buttons"><button class="customer-rating__top__rating-buttons__good"><i class="iconrating-good"></i> Hài lòng </button><button class="customer-rating__top__rating-buttons__bad"><i class="iconrating-bad"></i> Không hài lòng </button></div>
                                                        <div class="customer-rating__top__thank-you"> Cám ơn Anh Đào Văn Cường đã dành thời gian góp ý để Điện Máy Xanh cải thiện dịch vụ tốt hơn. </div>
                                                    </div>
                                                    <div class="customer-rating__bottom">
                                                        <span>
                                                            <textarea placeholder="Điều gì khiến Anh Đào Văn Cường không hài lòng? (không bắt buộc)" maxlength="300" class="customer-rating__bottom__input"></textarea>
                                                            <!---->
                                                        </span>
                                                        <div class="customer-rating__bottom__button-container"><button class="customer-rating__bottom__button-container__btn">Gửi góp ý</button></div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </section>

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
