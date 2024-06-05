@extends('frontend.layouts.apps')

@section('content')


@if (!empty($input))

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/lib/cart-result.min.css') }}">

<style type="text/css">
    .section-form{
        height: 500px;
    }
    .middleCart{
        height: 500px;
    }
</style>
<section class="section-form">
    <div class="middleCart">
        <!---->
        <div class="alertsuccess-new"><i class="new-cartnew-success"></i><strong>Đặt hàng thành công</strong></div>
        <div class="ordercontent">
            <p>Cảm ơn khách hàng <b>{{ @$input['name'] }}</b> đã cho Điện Máy Người Việt cơ hội được phục vụ.</p>
            <!---->
            <div>
                <!---->
                <div class="info-order" style="">
                    <div class="info-order-header">
                        <h4>Đơn hàng: <span>{{ @$input['orderId'] }}</span></h4>
                       <!--  <div class="header-right">
                            <a href="javascript:void(0)" onclick="modal_show()">Quản lý đơn hàng</a>
                        </div> -->
                    </div>
                    <label>
                        <span class="">
                            <i class="info-order__dot-icon"></i><span><strong>Người đặt hàng: </strong>{{ @$input['name'] }}, {{ @$input['phone_number']  }}</span><!---->
                        </span>
                    </label>
                    <label>
                        <span class="">
                            <i class="info-order__dot-icon"></i><span><strong>Giao đến: </strong>{{ @$input['address'] }}.</span><!---->
                        </span>
                    </label>
                    <label>
                        <span class="">
                            <i class="info-order__dot-icon"></i><span><strong>Tổng tiền: </strong><b>
                           {{ str_replace(',' ,'.', number_format($input['total_price'])) }} ₫</b></span><!---->
                        </span>
                    </label>
                    <!----><!----><!----><!---->
                </div>
            </div>
            <ul class="collection col-md-12">
                <li class="collection-item">
                    <div>
                        <a href="/">Nhấn Vào Đây Nếu Bạn Muốn Mua Tiếp</a>
                    </div>
                </li>
            </ul>
           
        </div>
    </div>
    
</section>
@else
    
    <section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">

    <div class="container-productbox">

        <div style="margin-left: 20px;" class="mt-3">
            <h2><b>Không tìm thấy link</b></h2>
        </div>
        <hr>

    </div>


  
    <div class="errorcompare" style="display:none;"></div>
   <!--  <div class="block__banner banner__topzone">
        <a data-cate="0" data-place="1919" href="https://www.topzone.vn/" onclick="jQuery.ajax({ url: '/bannertracking?bid=48557&r='+ (new Date).getTime(), async: true, cache: false });"><img style="cursor:pointer" src="https://cdn.tgdd.vn/2021/12/banner/Frame4879-1200x120.jpg" alt="Promote Topzone" width="1200" height="120"></a>
    </div> -->
    <div class="watched"></div>
    <div class="overlay"></div>

   
   
</section>
@endif

@endsection