@extends('frontend.layouts.apps')
@section('content') 
@push('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />

    

@endpush
<style type="text/css">
    #data-pricetotal{
        width: 194px;
    }
    .content  a{
        font-weight: bold;
    }
    .p-gift {
        padding: 10px;
        border: 1px solid #f8810c;
        border-radius: 3px;
        margin-top: 10px;
    }

    .loader {
      height: 5rem;
      width: 5rem;
      border-radius: 50%;
      border: 10px solid orange;
      border-top-color: #002147;
      box-sizing: border-box;
      background: transparent;
      animation: loading 1s linear infinite;
      position: absolute;
        top: 50%;
        left: 45%;
        z-index: 999;
        display: none;
    }

    .fa-angle-left{

        position: absolute;
        top: 50%;
        left: 0;
    }

    .fa-angle-right{
        position: absolute;
        top: 50%;
        right: 0;
    }
    .select-gift{
        display: flex;
    }

    @keyframes loading {
      0% {
        transform: rotate(0deg);
      }
      0% {
        transform: rotate(360deg);
      }
    }

    div.stars {
    width: auto !important;
    }   
    .installment-purchase .but-tra-gop {
        text-decoration: none;
        color: #333;
        font-size: 14px;
        padding: 8px 5px;
        line-height: 18px;
        width: 100%;
        border-radius: 5px;
        display: inline-block;
        text-align: center;
        cursor: pointer;
        background: #ffde00;
    }

    .giohang {
         background: #52a8d9 !important;
    }    

    .modal-body tr{

        height: 50px !important;
    }

    @media screen and (min-width: 576px){
        .modal-dialog {
            max-width: 800px !important;
            
        }
    } 
    @media screen and (max-width: 776px){
            .header__top {
                background-color: #DD2C44;
            }   

             .commitment ul {

                line-height: 28px !important;
                margin-top: 10px;

            }  
             .content img{
                
                height: auto !important;
            }  
        } 

       
        .box01__show{

            min-height: auto !important;
        }

        .breadcrumb{

            text-overflow: ellipsis;
            overflow: visible;
            white-space: nowrap;
        }

        .detail h1{
            padding: 0 15px;
        }



        .installment-purchase .but-1-gop {
            text-decoration: none;
            color: #333;
            font-size: 12px;
            padding: 8px 5px;
            line-height: 18px;
            width: 100% !important;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            background: #ffde00;
        }   
        
        @media screen and (min-width: 777px){
            .style-number-fone{
                display: flex;
            }
            #thongso td{
                height: 30px !important;
            }
            .pdetail-installment table{
                width: 430px !important;
                overflow: hidden;
            }
            .pdetail-installment{
                height: 400px;
                width: 430px;
                overflow: hidden;
            }
            .pdetail-installment td{
                padding-left: 5px;
            }
            .Salient_Features td{
                padding: 0 15px;
            }
            .view-all {
                position: absolute;
                width: 440px;
                /*left: 0;*/
                bottom: 0;
                padding: 6px 0;
                font-weight: 300;
                cursor: pointer;
                text-align: center;
                font-size: 14px;
                color: #288ad6;
                background: #fff;
                border: 1px solid #288ad6;
                border-radius: 4px;
                transition: 0.6s ease-out;
            }
            .modal-body table td{
                padding:  0 15px !important;
            }
            .pdetail-installment td{
                height: 30px !important;
            }
            .tbl_time_top thead td {
                font-weight: bold;
            }

            .prod-info .btn-buy{
                width: 100%;
                text-align: center;
            }
            .prod-info{
                display: none;
            }
            .item{
                width: 100%;
                
            }
            .box01 .owl-carousel .owl-item{
                width: 100%;

            }
            .detail h1 {
                padding: 0 15px;
            }
            .box02{
                display: none;
            }

            .content img{
                width: 100% !important;
                height: auto !important;
            }

          
            /*.box01 .owl-carousel .owl-item img{
                width: 100% !important;
            }
          */

        
        } 
</style>

<?php  

        
         
         if(!Cache::has('deal_details'.$data->id)){

            $check_deals  =   App\Models\deal::select('deal_price','start', 'end')->where('product_id', $data->id)->where('active', 1)->first();

            

            $check_deals = $check_deals??'';

            Cache::put('deal_details'.$data->id,$check_deals,10);
             
            
        }
        
        $check_deal = Cache::get('deal_details'.$data->id);
       

    $deal_check_add = false;
    
    if(!empty($check_deal) && !empty(!empty($check_deal->deal_price))){
         $now  = Carbon\Carbon::now();
        $timeDeal_star = $check_deal->start;
        $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
        $timeDeal_end = $check_deal->end;
        $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
        $timestamp = $now->diffInSeconds($timeDeal_end);

        if($now->between($timeDeal_star, $timeDeal_end)){
            $deal_check_add = true;
            $price_old = $data->Price;
            $text = '<b>MUA ONLINE GIÁ SỐC: </b>';
            $data->Price = $check_deal->deal_price;
            $percent = ceil((int)$price_old/$data->Price);
        }
    
        
    
    }


    if(!Cache::has('groupsProductDetails') ){

        $groupProducts = App\Models\groupProduct::select('name', 'link', 'product_id','id')->where('level', 0)->get();

        Cache::put('groupsProductDetails', $groupProducts, 10000);

    }

    $groupProduct = Cache::get('groupsProductDetails');
    

    foreach($groupProduct as $groupProducts ){

        if(!empty(json_decode($groupProducts->product_id))){

            if(in_array($data['id'],json_decode($groupProducts->product_id))){

                $groupName = $groupProducts->name;

                $groupLink = $groupProducts->link;

                $groupProductId =  $groupProducts->id;

                
            }
        }
    }



    if(!Cache::has('gifts_Fe_sss'.$data['id'])){

        $gifts = gift($data['id']);


        if(empty($gift)){

            if(!empty($groupProductId)){
                $gifts = groupGift($groupProductId);
            }   
           
            
            if(empty($gifts)){


                $gifts =[];
            }
        }
        Cache::put('gifts_Fe_sss'.$data['id'], $gifts,10000);

    }
   
    $gift = Cache::get('gifts_Fe_sss'.$data['id']);


   


    if(!empty($gift)){
        $gifts = $gift['gifts'];
        $gift = $gift['gift'];

    }
    
    ?>
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/detailsfe.css') }}?ver=6">
@endpush
<div class="locationbox__overlay"></div>
<div class="locationbox">
    <div class="locationbox__item locationbox__item--right" onclick="OpenLocation()">
        <p>Chọn địa chỉ nhận hàng</p>
        <a class="cls-location" href="javascript:void(0)">Đóng</a>
    </div>
    <div class="locationbox__item" id="lc_title"><i class="icondetail-address-white"></i><span> Vui lòng đợi trong giây lát...</span></div>
    <div class="locationbox__popup" id="lc_pop--choose">
        <div class="locationbox__popup--cnt locationbox__popup--choose">
            <div class="locationbox__popup--chooseDefault">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <b id="h-provincename" style="display:none!important" data-provinceid="3">Hồ Chí Minh</b>
</div>
<section data-id="235791" data-cate-id="1942" class="detail ">
    <ul class="breadcrumb">
        
        <li>
            <a href="{{route('homeFe')}}">Trang chủ</a>
            <meta property="position" content="1">
        </li>
        @if(!empty($groupLink))
        <li>
            <span>›</span>
            <a href="{{ route('details', $groupLink??'') }}">{{ @$groupName }}</a>
            <meta property="position" content="2">
        </li>
        @endif
        <!-- <li>
            <span>›</span>
            <a href="/tivi?g=smart-tivi">Smart Tivi</a>
            <meta property="position" content="3">
            </li> -->
        <li>
            <span>›</span>
            <a href="{{ route('details',$data->Link) }}">{{ $data->Name }}</a>
            <meta property="position" content="4">
        </li>
    </ul>
    <h1>{{ $data->Name }}</h1>
    <div class="box02">
        <div class="box02__left">
            <div class="detail-rate">
                <p>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
            </div>
        </div>
    </div>
    
    <div class="box_main">
        <div class="box_left">
            <div class="box01">
                <div class="box01__show">
                    <div class="owl-carousel detail-slider" id="carousel">

                        <div class="item">
                            <a href="{{ asset($data->Image) }}" data-fancybox="gallery"><img src="{{ asset($data->Image) }}" alt="{{ @$data->Name }}"></a>
                        </div>
                       
                        @isset($images)
                        @foreach($images as $image)

                        @if(trim($image->image) != trim($data->Image))
                        <div class="item">
                            <a href="{{ asset($image->image) }}" data-fancybox="gallery"><img src="{{ asset($image->image) }}"  data-src="{{ asset($image->image) }}" class="lazyload" alt="{{ @$data->Name }}"></a>
                            
                        </div>
                        @endif
                        @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div class="pay mobile">
                <div class="col-12 pdetail-des">
                    <div class="clearfix"></div>
                    <div>
                        <div class="pdetail-info">
                            <p>Model: <b>{{ @$data->ProductSku  }}</b></p>
                            <!-- <p>Bảo hành: <b>24 Tháng, 1 đổi 1 trong vòng 1 tháng</b></p> -->
                        </div>
                        <div class="scroll-box">
                            <div class="boxbanner-32">
                                <div class="banner-list">
                                    <div class="item banner-item banner-item-1">
                                        <a target="&quot;_blank&quot;" href="#" data-id="1022">
                                            <!-- <picture>
                                                <img src="https://thegioidohoacom.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/2019/01/10040348/X4iNCOp-1024x454.jpg" alt="Tết Lớn Khuyến Mại Lớn" width="&quot;640&quot;" height="&quot;150&quot;">
                                            </picture> -->
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="pdetail-price">
                                <div class="pdetail-price-box">
                                    {!! @$text !!}
                                    <h3> {{ str_replace(',' ,'.', number_format($data->Price)) }}₫ </h3>
                                </div>

                                
                                
                            </div>
                            <div class="pdetail-status">
                                <div class="pdetail-stockavailable">
                                    <?php
                                        if($data->Quantily==0||$data['Price']==0){
                                            $status ='Tạm hết hàng';
                                        
                                        }
                                        elseif($data->Quantily<=-1){
                                            $status ='Ngừng kinh doanh';
                                        }
                                        else{
                                            $status = 'Còn hàng';
                                        }


                                        
                                        ?>
                                    <span>{{ $status }}</span>
                                </div>

                                 @if(!empty($gift) &&  $data->Quantily>0 &&  $data['Price']>0 && $deal_check_add ==false)

                                <fieldset class="p-gift">
                                        <legend id="data-pricetotal" style="color: #ff0000;font-size: 18px; font-weight: bold" data-pricetotal="0">
                                            Khuyến mãi kèm theo
                                        </legend>
                                        <!---->
                                        <div class="detail-offer">
                                           
                                            {{ $gifts->type ==1?'Lựa chọn 1 trong 2 sản phẩm sau':'' }}
                                            @foreach($gift as $key => $valuegift)
                                            <div class="select-gift">
                                                

                                                <input type="checkbox" name="gift" value="{{ $valuegift->name }}" class="gift-check">
                                                
                                                <img src="{{ asset($valuegift->image) }}" height="30px" width="30px">

                                                @if($valuegift->id ==5)
                                                <a href="https://dienmaynguoiviet.vn/khau-trang-loc-khi-lg-puricare-the-he-2-ap551awfa-ajp-may-trang"><h4>{{ $valuegift->name }}</h4></a>
                                                @else
                                                <h4>{{ $valuegift->name }}</h4>
                                                @endif
                                            </div>
                                            @endforeach
                                           
                                        </div>
                                        <div class="img-gift clearfix">
                                        </div>
                                    </fieldset>
                                 @endif    

                                <!-- <div class="pdetail-promotion">
                                    <div class="pdetail-promotion-body">
                                        <ul>
                                            Tặng máy đánh trứng đa năng Roler RHM-1002 trị giá 790,000đ
                                            <li>Tặng eVoucher trị giá 200,000đ mua phụ kiện IT, phụ kiện Mobile (có giá trị sử dụng trong 07 ngày). Chi tiết xem <a href="https://mediamart.vn/tin-khuyen-mai/tang-voucher-tri-gia-200-000vnd-mua-cac-san-pham-phu-kien" target="_blank">tại đây</a>.</li>
                                            <li>TÀI TRỢ TRẢ GÓP 0% LÃI SUẤT (*)</li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div> -->

                                <!-- mobile -->
                                @if($data->Quantily>0)
                                <div class="pdetail-add-to-cart add-to-cart">
                                    <div class="inline">
                                        <input type="hidden" name="productId" value="{{ $data->id }}">
                                        <input type="hidden" name="gift_checked"  id="gift_checked" value="">
                                        <!-- <div class="product-quantity">
                                            <input type="text" class="quantity-field" readonly="readonly" name="qty" value="1">
                                            </div> -->
                                        <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart" onclick="addToCart({{ $data->id }})">MUA NGAY <br>(Giao hàng tận nơi - Giá tốt - An toàn)</button>
                                    </div>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Launch demo modal
                                        </button> -->
                                </div>
                                <div class="clearfix"></div>
                                @if((int)$data['Price']>=3000000)
                                <div class="installment-purchase pdetail-installment">
                                   
                                    <a target="_blank"  href="{{ route('details', $data->Link)  }}?show=tra-gop" admicro-data-event="101725" admicro-data-auto="1" admicro-data-order="false" class="but-1-gop">
                                    <strong>TRẢ GÓP QUA THẺ</strong>
                                    <br>
                                    (Visa, Master, JCB)
                                    </a>
                                </div>
                                @endif

                                @else

                                <div class="pdetail-add-to-cart add-to-cart">
                                    <div class="inline">
                                       
                                      
                                        <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart">Liên hệ</button>
                                    </div>
                                   
                                </div>
                                @endif
                            </div>
                            <div class="clearfix"></div>


                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-3 mobile">
                <div class="commitment">
                <h4>Yên tâm mua sắm</h4>
                <ul>
                    <li>Bảo hành tại nhà</li>
                    <li>Lắp đặt miễn phí</li>
              (Trừ điều hòa, bình nước nóng)
                    <li>Thanh toán tại nhà</li>
                    <li>Giao hàng miễn phí 20km</li>
                    <li>Giá cạnh tranh nhất thị trường</li>
                    <li>Đổi mới 100% trong 7 ngày đầu</li>
                        ( Trừ Sanaky, Sony chỉ bảo hành tại nhà )
                </ul>
                <div class="support">
                  <h5>Tổng Đài mua hàng</h5>
                    <a href="tel:02473036336">0247.303.6336</a>
                  <h5>Tổng Đài mua hàng( Sau 17h )</h5>
                   <a href="tel:0913011888">091.301.1888</a> 
                   <a href="tel:0983612828">098.361.2828</a>
                   
                                          
                  
                   
                </div>
                </div>
            </div>
            <div class="total-imgslider">
                <a id="show-popup-featured-images-gallery" style="display: block" href="javascript:void(0)"  data-color-id="0" data-toggle="modal" data-target="#Salient_Features">Xem tất cả điểm nổi bật</a>
            </div>

            <div class="scrolling_inner">
                <div class="box01__tab scrolling">
                    <div id="thumb-featured-images-gallery-0" class="item itemTab active " data-gallery-id="featured-images-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True" data-toggle="modal" data-target="#Salient_Features" class="read-full" data-gallery-id="featured-images-gallery">
                        <div class="item-border">
                            <i class="icondetail-noibat"></i>
                        </div>
                        <p>Điểm nổi bật</p>
                    </div>
                    <div id="thumb-specification-gallery-0" class="item itemTab  is-show-popup" data-gallery-id="specification-gallery" data-color-id="0" data-is-full-spec="True" data-color-order-id="0" data-isfeatureimage="True">
                        <div class="item-border">
                            <i class="icondetail-thongso" data-toggle="modal" data-target="#specifications"></i>
                        </div>
                        <p data-toggle="modal" data-target="#specifications">Thông số kỹ thuật</p>
                    </div>

                   <!--  <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div> -->

                    <div id="thumb-article-gallery-0" class="item itemTab  is-show-popup" data-gallery-id="article-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                        <div class="item-border">
                            <i class="icondetail-danhgia"></i>
                        </div>
                        <p>Thông tin sản phẩm</p>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Salient_Features" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Đặc điểm nổi bật</h5>
                        </div>


                       
                        <div class="modal-body" style="padding:0 15px">

                        
                            {!!  str_replace(['Xem thêm', 'Đặc điểm nổi bật'], '', html_entity_decode($data->Salient_Features))  !!} 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="specifications" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Thông số kỹ thuật</h5>
                            <button type="button" class="btn btn-secondary mobiles" data-dismiss="modal">x</button>
                        </div>

                        
                        <div class="modal-body" id="thong-so">
                            {!!  $data->Specifications  !!} 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-tab">
                <div class="bt-overlay"></div>
                <ul class="block-tab-top">
                    <li id="tab-featured-images-gallery-0"
                        class="tab-item active"
                        data-is-360-gallery="False"
                        data-gallery-id="featured-images-gallery"
                        data-color-id="0"
                        data-thump-name="&#x110;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t">
                        &#x110;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t
                    </li>
                    <li id="tab-color-images-gallery-11"
                        class="tab-item "
                        data-is-360-gallery="False"
                        data-gallery-id="color-images-gallery"
                        data-color-id="11"
                        data-thump-name="&#x110;en">
                        &#x110;en
                    </li>
                    <li id="tab-specification-gallery-0"
                        class="tab-item "
                        data-is-360-gallery="False"
                        data-gallery-id="specification-gallery"
                        data-color-id="0"
                        data-thump-name="Th&#xF4;ng s&#x1ED1; k&#x1EF9; thu&#x1EAD;t">
                        Th&#xF4;ng s&#x1ED1; k&#x1EF9; thu&#x1EAD;t
                    </li>
                    <li id="tab-article-gallery-0"
                        class="tab-item "
                        data-is-360-gallery="False"
                        data-gallery-id="article-gallery"
                        data-color-id="0"
                        data-thump-name="Th&#xF4;ng tin s&#x1EA3;n ph&#x1EA9;m">
                        Th&#xF4;ng tin s&#x1EA3;n ph&#x1EA9;m
                    </li>
                </ul>
                <div class="block-tab-content">
                    <div class="content-t active not-load-content" id="tab-content-featured-images-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-color-images-gallery-11">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-specification-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-article-gallery-0">
                    </div>
                </div>
            </div>
            <div class="wrap_wrtp hide" id="popup-materialsfee">
                <div class="pop">
                </div>
            </div>
            <div class="content">
                 

                <?php

                     $minutes = 1000;

                    $check = Cache::remember('check',$minutes, function() use ($data){
                        return DB::table('imagecrawl')->select('image')->where('product_id', $data->id)->where('active',0)->get()->pluck('image')->toArray();
                    });


                     $details = $data->Detail;
                    if(isset($check)){

                        
                        $details = str_replace($check,  asset('/images/product/noimage.png'), $data->Detail);
                        $details = str_replace(['http://dienmaynguoiviet.net', 'https://dienmaynguoiviet.net'], 'https://dienmaynguoiviet.vn', $details);
                        $details = preg_replace("/<a(.*?)>/", "<a$1 target=\"_blank\">",  $details);
                        

                    }
                   
                   
                ?>

                 {!! html_entity_decode($details)   !!}
                
            </div>
            <div class="show-more">
                <span>Đọc thêm</span>
            </div>
            <div class="border7"></div>
        </div>
        <div class="box_right desktop">
            <div class="col-12 pdetail-des">
                <div class="clearfix"></div>
                <div>
                    <div class="pdetail-info">
                        <p>Model: <b>{{ @$data->ProductSku  }}</b></p>
                        <!-- <p>Bảo hành: <b>24 Tháng, 1 đổi 1 trong vòng 1 tháng</b></p> -->
                    </div>
                    <div class="scroll-box">
                        <!-- <div class="boxbanner-32">
                            <div class="banner-list">
                                <div class="item banner-item banner-item-1">
                                    <a target="#" data-id="1022">
                                        <picture>
                                           
                                            <img src="https://thegioidohoacom.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/2019/01/10040348/X4iNCOp-1024x454.jpg" alt="Tết Lớn Khuyến Mại Lớn" width="&quot;640&quot;" height="&quot;150&quot;">
                                        </picture>
                                    </a>
                                </div>
                            </div>
                            </div> -->
                            <style type="text/css">
                                
                                .crazy-deal-details-right {
                                    position: relative;
                                    margin-left: 113px;
                                    height: 100%;
                                    display: flex;
                                    align-items: center;
                                    flex-direction: row;
                                    justify-content: space-between;
                                }
                                .crazy-deal-details-procressbar{
                                    width: 90px;
                                    height: 8px;
                                    background: #ffd1c2;
                                    border-radius: 4px;
                                    display: inline-block;
                                    margin-right: 6px;
                                    margin-left: 6px;
                                }
                                .crazy-deal-details-process{
                                    font-weight: bold;
                                    margin-right: 10px;
                                }
                                .crazy-deal-details.pc {
                                    margin: 8px;
                                    height: 29px;
                                    overflow: hidden;
                                    background-position: 0 0;
                                    background-repeat: no-repeat;
                                    background-size: 100% 100%;

                                }    
                                .crazy-deal-details-countdown{
                                    font-weight: bold;
                                }
                            </style>
                        <div class="pdetail-price">
                            @if(!empty($text))
                            <?php 

                                if($data->id%2==0){
                                    $numberDeal = 6;
                                }
                                else{
                                    $numberDeal = 5;
                                }
                            ?>
                            <div id="module_flash_sale" class="pdp-block module">
                                <div class="crazy-deal-details pc" style="background-image:url('{{ asset('images/template/flashsale.png')  }}'); height:38px">
                                    <div class="crazy-deal-details-right">
                                        <time class="crazy-deal-details-countdown" data-spm-anchor-id="a2o4n.pdp_revamp.0.i0.89db8552daSXV6">Kết thúc sau <span class="crazy-deal-details-countdown-time clock">12:08:36</span></time>
                                        <div class="crazy-deal-details-process">
                                            Đã bán {{ $numberDeal }} sản phẩm
                                            <!-- <div class="crazy-deal-details-procressbar">
                                                <div class="crazy-deal-details-procressbar-inner" style="width:9%"></div>
                                            </div> -->
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  <div class="tbl_time_top">
                                <table class="tbl_time" width="100%">
                                    <thead>
                                    <tr>
                                        <td align="center">Tiết kiệm</td>
                                        <td align="center">Đã mua</td>
                                        <td align="center">Thời gian còn lại</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr bgcolor="#eee">
                                        <td align="center">{{@$percent}}%</td>
                                        <td align="center">0</td>
                                        <td align="center"><div id="to_time1205" class="clock" data-id="1205" data-time-left="133131"></div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> -->
                            @endif
                            <br>
                             {!!  @$text !!}
                            <div class="pdetail-price-box">

                                <h3>
                                     {{str_replace(',' ,'.', number_format($data->Price))  }}₫
                                </h3>
                            </div>
                            <!-- <div class="pdetail-promotion">
                                <div class="pdetail-promotion-body">
                                    <ul>
                                        Tặng máy đánh trứng đa năng Roler RHM-1002 trị giá 790,000đ
                                        <li>Tặng eVoucher trị giá 200,000đ mua phụ kiện IT, phụ kiện Mobile (có giá trị sử dụng trong 07 ngày). Chi tiết xem <a href="https://mediamart.vn/tin-khuyen-mai/tang-voucher-tri-gia-200-000vnd-mua-cac-san-pham-phu-kien" target="_blank">tại đây</a>.</li>
                                        <li>TÀI TRỢ TRẢ GÓP 0% LÃI SUẤT (*)</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                </div> -->
                        </div>
                        <div class="pdetail-status">
                            <div class="pdetail-stockavailable">
                                <span>{{ $status }} </span>
                            </div>

                            
                             @if(!empty($gift) && $data->Quantily>0 && $deal_check_add ==false  &&  $data['Price']>0)

                            <fieldset class="p-gift">
                                    <legend id="data-pricetotal" style="color: #ff0000;font-size: 18px; font-weight: bold" data-pricetotal="0">
                                        Khuyến mãi kèm theo
                                    </legend>
                                    <!---->
                                    <div class="detail-offer">
                                       
                                        {{ $gifts->type ==1?'Lựa chọn 1 trong 2 sản phẩm sau':'' }}
                                        <div class="select-gift">
                                            
                                          
                                             @foreach($gift as $key => $valuegift)
                                              @if($gifts->type ==1)<input type="checkbox" name="gift" value="{{ $valuegift->name }}" {{ $key==0?'checked':'' }}> @endif
                                            <img src="{{ asset($valuegift->image) }}" height="30px" width="30px">

                                             @if($valuegift->id ==5)
                                                <a href="https://dienmaynguoiviet.vn/khau-trang-loc-khi-lg-puricare-the-he-2-ap551awfa-ajp-may-trang"><h4>{{ $valuegift->name }}</h4></a>
                                                @else
                                                <h4>{{ $valuegift->name }}</h4>
                                                @endif
                                                
                                            @endforeach
                                          

                                        </div>
                                        
                                       
                                    </div>
                                    <div class="img-gift clearfix">
                                    </div>
                                </fieldset>
                             @endif    

                            @if($data['Quantily']>0)
                            <div class="pdetail-add-to-cart add-to-cart">
                                <form class="inline">
                                    <input type="hidden" name="productId" value="19439">
                                    <!-- <div class="product-quantity">
                                        <input type="text" class="quantity-field" readonly="readonly" name="qty" value="1">
                                        </div> -->
                                    @if((int)$data['Price']>0)
                                    <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart" onclick="addToCart({{ $data->id }})">MUA NGAY <br>(Giao hàng tận nơi - Giá tốt - An toàn)</button>
                                    @else
                                    <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart">LIÊN HỆ <br></button>
                                    @endif
                                </form>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Launch demo modal
                                    </button> -->
                            </div>
                            <div class="clearfix"></div>


                            <div class="installment-purchase pdetail-installment">
                                
                                @if((int)$data['Price']>=3000000)
                               
                                <a target="_blank" class="but-tra-gop" href="{{ route('details', $data->Link)  }}?show=tra-gop" admicro-data-event="101725" admicro-data-auto="1" admicro-data-order="false">
                                <strong>TRẢ GÓP QUA THẺ</strong>
                                <br>
                                (Visa, Master, JCB)
                                </a>
                                @endif
                                <br><br>
                                {!!  $data->Specifications  !!} 
                            </div>
                            @else

                            <div class="pdetail-add-to-cart add-to-cart pdetail-installment">
                                <div class="inline">
                                   
                                  
                                    <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart">Liên hệ</button>
                                </div>

                                {!!  $data->Specifications  !!} 
                            </div>
                           
                            @endif

                        </div>
                        <div class="clearfix"></div>

                         <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#specifications">Xem chi tiết thông số kỹ thuật</button>
                       
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="border7"></div>
        <div class="clearfix"></div>
        <div class="related view-more-related viewer-product">
        </div>
        <div class="col-md-8 clearfix" id="comment_pro">
            <article id="article-comment-2131" itemprop="comment" itemscope="" itemtype="https://schema.org/Comment">
                <?php 
                    if(!Cache::has('comment'.$data->id) ){

                        $comments_id = App\Models\rate::where('product_id', $data->id)->Where('active', 1)->get();

                        Cache::put('comment'.$data->id, $comments_id, 10000);

                    }

                    

                    $comment = Cache::get('comment'.$data->id);
                    ?>
                @if(isset($comment))
                @foreach($comment as $comments)
                <header class="comment-header">
                    <p class="comment-author" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                        <img alt="" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPyGNr2qL63Sfugk2Z1-KBEwMGOfycBribew&usqp=CAU" height="30px" width="30px">
                        <span class="comment-author-name" itemprop="name">
                        <a href="#" class="comment-author-link" rel="external nofollow" itemprop="url">{{ $comments->name }}</a>
                        </span> 
                    <p class="comment-meta"><time class="comment-time" itemprop="datePublished"><a class="comment-time-link" href="https://nguyenhung.net/comment-trong-html.html#comment-2131" itemprop="url">{{ $comments->created_at->format('d/m/Y, H:i' )  }}</a></time></p>
                </header>
                <div class="comment-content" itemprop="text">
                    <p>{!!  $comments->content  !!}</p>
                </div>
                @endforeach
                @endif
            </article>
            <div class="rate-text">
                <!-- <h3 style="margin-bottom: 0;margin-top: 40px;"> Đánh giá  {{ $data->Name }}</h3> -->
                <p style="background: #f3f3f3;padding: 10px;border-radius: 3px;margin: 10px 0;">Đánh giá sản phẩm nhận Coupon 20.000đ dành cho khách mua hàng tại Điện máy người việt.</p>
            </div>
            <div class="p-comment">
                <form class="comment-form" name="rate-form" id="rate-form" role="form">
                    <div class="rate_view">
                        Chọn đánh giá của bạn:
                        <div class="stars">
                            <div>
                                <input class="star star-click star-5" id="star-5" type="radio" name="star"/>
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-click star-4" id="star-4" type="radio" name="star"/>
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-click star-3" id="star-3" type="radio" name="star"/>
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-click star-2" id="star-2" type="radio" name="star"/>
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-click star-1" id="star-1" type="radio" name="star"/>
                                <label class="star star-1" for="star-1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="left">
                            <textarea style="padding: 10px;border-radius: 3px; width: 100%;" name="content" placeholder="Nhập đánh giá về sản phẩm " id="content0"></textarea>
                        </div>
                        <div class="left">
                            <div class="form-input">
                                <table style="width:100%;" class="tbl-common">
                                    <tbody>
                                        <tr>
                                            <td style="padding-right: 5px;">
                                                <input style="border-radius: 3px;height: 43px;" type="text" id="name0" name="name" class="inputText" placeholder="Họ tên" value="">
                                            </td>
                                            <td style="padding-left: 5px;">
                                                <input style="border-radius: 3px;height: 43px;" type="text" id="email0" name="email" class="inputText" placeholder="Email" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input style="margin-top: 15px;width: calc(100% - 6px);border-radius: 3px;" type="submit" value="Gửi bình luận" class="btn btn-red comments-rate" ></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--form-input-->
                        </div>
                    </div>
                </form>
                <input type="hidden" name="star" id="star_number" value="5">
                <!--comment-form-->
            </div>
        </div>
        <!-- end đánh giá -->
        <div class="related view-more-related">
            <p class="related__ttl">Xem thêm sản phẩm khác</p>
            @if(isset($other_product))
            <div class="listproduct slider-promo owl-carousel">
                @foreach($other_product as  $value)
                @if($value->active==1 && $value->id != $data->id)
                <div class="item">
                    <a href='{{ route('details', $value->Link) }}' class=" main-contain">
                    <div class="item-label">
                    </div>
                    <div class="item-img">
                        <img data-src="{{ asset($value->Image) }}" class="lazyload" alt="{{ $value->Name }}" width=210 height=210>
                    </div>
                    
                    <h3>{{ $value->Name }}</h3>
                    <strong class="price">{{  str_replace(',' ,'.', number_format($value->Price))  }}&#x20AB;</strong>
                    </a>
                </div>
                @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="border7"></div>
    <div class="watched"></div>
    </div>
    <div class="errorcompare" style="display:none;"></div>
    <!--#endregion-->
    <!--#region BreadcrumbList-->
    <!--#endregion-->
    <!--#region Organization-->
    <!--#endregion-->
</section>
<div class="prod-info txt_555 fix">
    <span class="name-scroll"> {{ $data->Name }} </span>
    <div class="vote" id="vote_avg">
        <div class="fl" style="padding:0 5px 0 0;">
            Model: <span class="value txt_blue">{{ $data->ProductSku }}</span> | 
            Tình trạng: <span class="value txt_blue">{{ $status }}</span> | 
        </div>
        <a id="btn-vote" class="txt_555 fl" href="javascript:;" onclick="go_comm()"> Đánh giá: </a>
        <div class=" totalRate " id="js-total-rating" style="display: inline-block;"><i class="icons icon-star star"><span></span></i></div>
        (<span class="reviewCount">0</span>)
    </div>
    <div class="prod-info-left fl">          
        <span class="robot txt_green txt_b txt_20">{{  str_replace(',' ,'.', number_format($data->Price))  }} &#x20AB;</span>
    </div>
    <div class="clear space3px"></div>
    <div class="clear space10px"></div>
   
       
    @if(!empty($gift) && $data->Quantily>0 && $deal_check_add ==false)   
    <div class="promo line_h19">
        <div class="txt_b">Khuyến mại: {{ $gifts->type ==1?'Lựa chọn 1 trong 2 sản phẩm sau':'' }}</div>
        <div style="display: flex;">
            @foreach($gift as $values)
            <img src="{{ @asset($values->image) }}" height="30px" width="30px">
            @if($values->id==5)
            <a href=""><p>{{ @$values->name??'' }}</p></a>
            @else
            <p>{{ @$values->name??'' }}</p>
            @endif
            <br>
            @endforeach
        </div>
    </div>

    @endif
   
    <div class="buy-group">
        @if($data->Quantily>0) 
        @if((int)$data->Price>0)
        <div class="clear space10px in">
            <a class="btn-buy txt_center cor5px buy-nows-popup" href="javascript:void(0)">
            <i class="fa fa-shopping-cart"></i> <span class="txt_15" onclick="addToCart({{ $data->id }})">Mua ngay</span>
            </a>
        </div>
        @endif
        @if((int)$data->Price>=3000000)
        <div class="clear space10px credit">
           
            <a class="btn-buy txt_center cor5px"  href="{{ route('details', $data->Link)  }}?show=tra-gop" style="background: #ffde00; border-bottom: 0;">
            <i class="fa fa-shopping-cart"></i> <span class="txt_15" >Trả góp qua thẻ</span>
            </a>
        </div>
        @endif
        @endif
       
    </div>
    <div class="clear"></div>
    <br>
    <style type="text/css">
        .commitment {
            border: 1px solid #0083d1;
            padding: 10px;
        }
        .commitment h4 {
            font-weight: bold;
            color: #ff9;
            text-transform: uppercase;
            font-size: 16px;
            margin: 0;
            padding: 10px;
            background-color: #fe0000;
            margin: -10px;
            margin-bottom: 0px;
            text-align: center;
        }
       .commitment ul {
            line-height: 3vmin;
        }
        .commitment .support a {
            color: #fe0000;
            font-size: 16px;
            font-weight: bold;
            display: block;
            line-height: 30px;
        }

        .commitment h5 {
          /*  font-weight: 500;*/
            font-size: 16px;
            text-transform: uppercase;
            margin: 0;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .commitment{
            width: 100%;
        }
        .commitment ul li::before {
            content: "\f00c";
            font-weight: 900;
            font-family: Font Awesome\ 5 Free;
            font-size: 8px;
            margin-right: 5px;
            color: #fff;
            border: 1px solid #fff;
            border-radius: 100%;
            width: 14px;
            height: 14px;
            display: inline-block;
            background-color: #ff3333;
            line-height: 13px;
            text-align: center;
        }
    </style>

    <div class="prod-info-right fr">

        <div>
            <div class="commitment">
                <div class="support">
                  <h5>Tổng Đài mua hàng</h5>
                    <a href="tel:02473036336">0247.303.6336</a>
                  <h5>Tổng Đài mua hàng( Sau 17h )</h5>
                  <div class="style-number-fone">
                        <a href="tel:0913011888">091.301.1888</a>&nbsp; &nbsp; &nbsp; <span>||</span> &nbsp; &nbsp; &nbsp;
                        <a href="tel:0983612828">098.361.2828</a>
                  </div>
                  
                   
                </div>
                <br>
                <div class="support1">
                    <h4>Yên tâm mua sắm</h4>
                    <ul>
                        <li>Bảo hành tại nhà</li>
                        <li>Lắp đặt miễn phí</li>
                  (Trừ điều hòa, bình nước nóng)
                        <li>Thanh toán tại nhà</li>
                        <li>Giao hàng miễn phí 20km</li>
                        <li>Giá cạnh tranh nhất thị trường</li>
                        <li>Đổi mới 100% trong 7 ngày đầu</li>
                            ( Trừ Sanaky, Sony chỉ bảo hành tại nhà )
                    </ul>
                </div>
                
                
               
            </div>
       <!--  <h4 class="format txt_13">
            <p class="format txt_b">Yên tâm mua sắm:</p>
        </h4>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Bảo hành tại nhà</p>
        </h5>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Gọi đặt mua: <span class="txt_b txt_red">02473036336</span> (cả dịp Lễ, Tết)</p>
        </h5>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Giao hàng miễn phí 20km</p>
        </h5>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Lắp đặt miễn phí
                (Trừ điều hòa, bình nước nóng)
            </p>
        </h5>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Thanh toán tại nhà</p>
        </h5>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Giá cạnh tranh nhất thị trường</p>
        </h5>
        <h5 class="format txt_13 txt_n">
            <p><i class="fa fa-check"></i> Đổi mới 100% trong 7 ngày đầu
                ( Trừ Sanaky, Sony chỉ bảo hành tại nhà )
            </p>
        </h5> -->
        <div class="clear"></div>
    </div>
    <!--right-->
    <div class="clear"></div>
    </div>
    <!--//prod-info-left -->

</div>
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/details.css') }}?ver=2">
@endpush
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    @if(!empty($gift) && $gifts->type ==1)
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
          } else {
            $box.prop("checked", false);
          }
    });
    @endif
    var gift_check = ''
    @if(!empty($gift) && $data->Quantily>0 && $deal_check_add==false)  
    gift_check  = '{{ $gift[0]->name }}';
    $('#gift_checked').val(gift_check);
    $('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
                gift_check = $(this).val();
               
            }

            $('#gift_checked').val(gift_check);
           
        });
    @endif

    $( document ).ready(function() {
        $('.box01 a').fancybox();
    
        $('.star-click').bind('click',function(){
            id_star = $(this).attr('id');    
            number_star = id_star.substr(5, 6);
            $('#star_number').val(number_star);
            // console.log(number_star);
           
        });
    
        $("#rate-form").validate({
            rules: {
                name: "required",
                content: "required",
                email: {
                    required: true,
                    email: true
                },
               
            },
             messages: {
                name: "vui lòng nhập tên",
                content: "vui lòng nhập đánh giá",
               
                email: {
                    required: "vui lòng nhập địa chỉ email",
                    email: "vui lòng nhập đúng định dạng email"
                },
              
            },
            submitHandler: function(form) {
                
              postComment();
    
            }
           
    
        }); 
    
    });  
    
    
    function postComment() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: "{{ route('rate-form') }}",
            data: {
                product_id: {{ $data->id }},
                email:$('#email0').val(),
                name:$('#name0').val(),
                content:$('#content0').val(),
                star:$('#star_number').val(),
                   
            },
            success: function(result){
    
                $('.comments-rate').text('Đã gửi bình luận');
                $('.comments-rate').val('Đã gửi bình luận');
    
                $('#email0').val('');
                $('#name0').val('');
                $('#content0').val('');
              
              alert(result);
            }
        });
    
    }  
    
    
    // chức năng sản phẩm đã xem
    
    
    function toUniqueArray(a){
        var newArr = [];
        for (var i = 0; i < a.length; i++) {
            if (newArr.indexOf(a[i]) === -1) {
                newArr.push(a[i]);
            }
        }
      return newArr;
    }
    
    product_id_item_viewer = [];
    
    const item_local_store =  JSON.parse(localStorage.getItem('viewed_product'));
    
    if(item_local_store !=null){
    
        product_id_item_viewer = item_local_store;
    }
    
    product_id_item_viewer.push('{{ $data->id }}');
    
    product_id_item_viewer = toUniqueArray(product_id_item_viewer);

     product_id_item_viewer.slice(0, 6);

    
    localStorage.setItem('viewed_product', JSON.stringify(product_id_item_viewer));
    
    view_product_id = localStorage.getItem('viewed_product');

    
    button_buy_height = $('.scroll-box').offset().top;
    view_more_height  = ($('.view-more-related').offset().top);
 
                
    $(".show-more span").bind("click", function(){
        $('.content').css({'height':'auto', 'overflow':'auto' });
        $(this).hide();
        view_more_height  = $('.view-more-related').offset().top-100;
    });
    
    $(function(){
        $(window).scroll(function(){
            const scroll_result = $('.total-imgslider').offset().top
            const scroll_browser = $(this).scrollTop();
    
            if(scroll_browser>= scroll_result &&scroll_browser <= view_more_height){
    
                $(".prod-info").show();
                
            }
            else{
                $(".prod-info").hide();
            }
    
        });
    });
    
</script>
<script type="text/javascript">

   
    $('.bar-top-left').hide();

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: "{{ route('show-viewed-product') }}",
        data: {
            product_id: view_product_id
               
        },
        success: function(result){
           // numberCart = result.find($("#number-product-cart").text());
           $('.viewer-product').append(result);
           
        }
    });    
    
    function addToCart(id) {
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: "{{ route('cart') }}",
            data: {
                product_id: id,
                gift_check:$('#gift_checked').val()
                   
            },
            beforeSend: function() {
               
                $('.loader').show();

            },
            success: function(result){
    
               //  numberProductCart = $(".number-cart").text();
    
               //  console.log(numberProductCart);
               
               // numberCart = result.find(numberProductCart);
    
                $('#tbl_list_carts').append(result);
    
                const numberCart = $('#number-product-cart').text();
    
                $('.number-cart').text(numberCart);
    
                $('#exampleModal').modal('show'); 
                $('.loader').hide();
                
            }
        });
        
    }

     function addCartFast(id) {
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: "{{ route('addcartfast') }}",
            data: {
                product_id: id,
                   
            },
            success: function(result){
    
                $('.number-cart').text(result);
                alert('Thêm sản phẩm vào giỏ hàng thành công !');

            }
        });
        
    }


    
    $('#carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        dots:true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
       
        responsive:{
            0:{
                items:1
    
            },
            600:{
                items:1
            },
            
            1000:{
                items:1
            }
        }
    });
    
    
    
    
    $('.listproduct').owlCarousel({
        loop:true,
    
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1.5
            },
            600:{
                items:1.5
            },
            1000:{
                items:5
            }
        }
    });

    @if(!empty($text))

        // đếm thời gian 

         //document.getElementById('svg').innerHTML = xmlSvg;
                                        
        time = '{{ @$timestamp }}';
        number_deal_product =10;
        //in time 
        var h = 12;
        var i = 0;
        var s = 0;
    
        amount = time //calc milliseconds between dates
        days = 0;
        hours = 0;
        mins = 0;
        secs = 0;
        out = "";
    
    
        hours = Math.floor(amount / 3600);
        amount = amount % 3600;
        mins = Math.floor(amount / 60);
        amount = amount % 60;
        secs = Math.floor(amount);
            
            
    
    
        //time run 
        if(parseInt(time)>0 && parseInt(number_deal_product)>0){
         h = hours;
          m = mins;
          s = secs;
        }   
        else{
            let today =  new Date();
            h = 99 - parseInt(today.getHours());
            m = 59 - parseInt(today.getMinutes());
            s = 59 - parseInt(today.getSeconds());
            
        }

        start();    
        function start()
        {

              /*BƯỚC 1: LẤY GIÁ TRỊ BAN ĐẦU*/
              if (h === null)
              {
                  h = parseInt($('.hour').text());

              }

              /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
              // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
              //  - giảm số phút xuống 1 đơn vị
              //  - thiết lập số giây lại 59
              if (s === -1){
                  m -= 1;
                  s = 59;
              }

              // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
              //  - giảm số giờ xuống 1 đơn vị
              //  - thiết lập số phút lại 59
              if (m === -1){
                  h -= 1;
                  m = 59;
              }

              // Nếu số giờ = -1 tức là đã hết giờ, lúc này:
              //  - Dừng chương trình
              //if (h == -1){

                 //clearTimeout(timeout);
                 //$('#timer-391923717').hide();
                  //return false;


              //}



              /*BƯỚC 1: HIỂN THỊ ĐỒNG HỒ*/



              var hour =  h.toString();

              var seconds =  s.toString();

              var minutes =  m.toString();



              // $('.hourss').text(h<10?'0'+hour:''+hour);
              // $('.secondss').text(s<10?'0'+seconds:''+seconds);
              // $('.minutess').text(m<10?'0'+minutes:''+minutes);

            let currentHour = h<10?'0'+hour:''+hour;
            let currentMinutes = m<10?'0'+minutes:''+minutes;
            let currentSeconds = s<10?'0'+seconds:''+seconds;

    
            let currentTimeStr =currentHour + ":" + currentMinutes + ":" + currentSeconds;

          

            $('.clock').html(currentTimeStr);

              // Insert the time string inside the DOM
           

              /*BƯỚC 1: GIẢM PHÚT XUỐNG 1 GIÂY VÀ GỌI LẠI SAU 1 GIÂY */
              timeout = setTimeout(function(){
                  s--;
                  start();


              }, 1000);
        }
    @endif    
</script>
@endpush
@endsection
