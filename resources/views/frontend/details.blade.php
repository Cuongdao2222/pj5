@extends('frontend.layouts.apps')
@section('content') 
@push('style')

    <?php 

        $thuonghieu = [1 => 5, 3 => 35, 2 =>56, 4 =>76, 6=>115, 7=>129];

        $namecate = Cache::rememberForever('namecate'.$data_cate, function() use($data_cate){

            $namecate = App\Models\groupProduct::find($data_cate)??'';

            return $namecate;
        });    

        if(!empty($thuonghieu[$data_cate])){

            $thuonghieuCate = $thuonghieu[$data_cate];

            $ar_groups_info = Cache::rememberForever('ar_groups_info_'.$data->id, function() use($thuonghieuCate, $data_cate, $data){

                $namecate = Cache::get('namecate'.$data_cate);

                $dataThuonghieu = App\Models\groupProduct::where('parent_id', $thuonghieuCate)->get();

                $ar_groups_info = [];

                foreach ($dataThuonghieu as $value) {

                    if (strpos(strtolower($data->Name), strtolower(str_replace($namecate->name, '', $value->name)))>-1) {

                        array_push($ar_groups_info, ['name'=>  $value->name, 'link'=>$value->link]);
                    }
                    
                }
                return $ar_groups_info;
            });

        }
    
    ?>

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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detailscs.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=19"> 
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detail1fe.css') }}?ver=5">

    <style type="text/css">

        @-webkit-keyframes my {
             0% { color: #EF0000; } 
             50% { color: #2B883E;  } 
             100% { color: #EF0000;  } 
         }
         @-moz-keyframes my { 
             0% { color: #EF0000;  } 
             50% { color: #2B883E;  }
             100% { color: #EF0000;  } 
         }
         @-o-keyframes my { 
             0% { color: #EF0000; } 
             50% { color: #2B883E; } 
             100% { color: #EF0000;  } 
         }
         @keyframes my { 
             0% { color: #EF0000;  } 
             50% { color: #2B883E;  }
             100% { color: #EF0000;  } 
         } 
         .nhapnhay {
            background:#FDDD39;
            font-size:18px;
            font-weight:bold;
             -webkit-animation: my 1700ms infinite;
             -moz-animation: my 1700ms infinite; 
             -o-animation: my 1700ms infinite; 
             animation: my 1700ms infinite;
        }

        .status-mobile{
            color: #218838;
            font-weight: bold;
        }


        .saker{
            position: absolute;
            left: 0;
            top: 0;
        }

       
        .redirectCart{
            font-weight: bold;
        }
        .but-carsp{
            background-color: #1053A7 !important;
        }

        .installment-purchase .but-tra-gop {
            width: calc(50% - 10px);
        }    
        .list-shows-click {
            display: inline-flex !important;
            width: calc(100% - 25%) !important;
            border: unset;
        }

        .gift_info  ol{
            list-style: auto !important;
        }

        strong a{
            font-weight: bold !important;
        }
        .pdetail-info p{
            margin-top: 10px;
        }

        .installments-but{
            margin-left: 15px;
            border: 1px solid #EA1D34;
        }

        .add-card-buttons {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            height: 54px;
           /* padding: 8px 5px;*/
           line-height: 54px !important;

            line-height: 18px;
            width: 100%;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            background: #ffde00;
        }

        .buyonline {
            padding: 10px 25px;
            border-radius: 3px;
            border: 1px dashed #019100;
            font-size: 14px;
            color: #019100;
            display: inline-block;
            margin: 11px 0;
        }

        .buyonline p{
            margin: 0;
        }

        ol li::marker {
          color: #fff;
          
        }
        ol li {
           position:relative;
           font-size:16px;
           margin-bottom: 10px;
        }
        ol li:before {
            content: "";
            position: absolute;
            left: -24px;
            top: -2px;
            background-color: #1053A7;
            z-index: -1;
            display: inline-block;
            width: 21px;
            height: 21px;
            border-radius: 50%;

        }
        .stock{
            padding: 0 15px;
        }

        .gift_item ul{
            margin-left: 15px;
        }

        .fa-solid{
            color: #1053A7;
        }

        .add-cart-button{
            border: 1px solid #EA1D34;
            background: #fff !important;
            color: #EA1D34 !important;
        }

        .box-compare{
            margin-left: 15px;
        }


        .gift_pro .ttl, .gift_pro h3 {
            padding: 9px 18px;
            position: relative;
            display: block;
            font-weight: 700;
        }

        .gift_item {
            padding: 10px 15px;
            margin-bottom: 5px;
        }

        
        .gift_pro {
            border: 1px solid #dedede;
            border-radius: 5px;
            margin-top: 18px;
        }

        .gift_pro .ttl, .gift_pro h3, .gift_pro h5 {
            font-family: Arial,Tahoma,sans-serif;
            font-size: 15px;
            color: #333;
            background: #f5f5f5;
            border-bottom: 1px solid #dedede;
        }




        .box03 .label {
            border-color: #2f80ed;
            color: #2f80ed;
        }

        .box03 .act{
            border-color: #2f80ed;
           
        }

         .box03 .act span{
           
            color: #2f80ed !important;
        }

         .price_market span{
            text-decoration: line-through
        }

        .box03__item {
            border: 1px solid #e0e0e0;
            border-radius: 2px;
            color: #333;
            display: inline-block;
            font-size: 13px;
            min-width: 67px;
            padding: 0 15px;
            text-align: center;
            margin-bottom: 5px;
            margin-right: 2px;
            vertical-align: top;
            height: 36px;
            line-height: 36px;
            position: relative;
            width: 20%;
        }

        .desk{
            display: flex;

            padding: 0 15px;
        }

        .cartSP{
             background: #1053A7;
        }

        .box-info-name{
            height: 40px;
        }

        .box-compare{
            height: 34px;
        }


        .one_size {
            display: inline-block;
            border: 1px solid rgb(222, 222, 222);
            border-radius: 5px;
            padding: 0px;
            cursor: pointer;
            box-sizing: border-box;
            margin: 6px 3px 0px;
        }

        .one_size .container-detail {
            padding: 0px 5px;
        }

        .container-detail {
            display: block;
            position: relative;
            text-align: center;
            cursor: pointer;
            margin: 2px 4px;
        }

        .container-detail .size-pro {
            font-family: Arial, Tahoma, sans-serif;
            font-size: 14px;
            color: rgb(51, 51, 51);
            margin-left: 0px;
            padding-left: 0px;
        }


        .one_size .container-detail .price-pro {
            display: block;
            font-size: 14px;
            color: rgb(51, 51, 51);
            font-weight: 400;
            line-height: 20px;
        }





        .discount_percent {
            color: #fff;
            background: #007bff;
            display: inline-block;
            vertical-align: middle;
            padding: 2px 5px;
        }


        @media screen and (min-width: 768px) {
            .support {
                width: 70%;
                margin: 0 auto;
                text-align: center;
            }

            .cartSP{
                margin-left: 4px;
               
            }

            .add-to-cart{
                display: flex;
            }

            .btn-add-cart{
                padding: 8px 16px;
            }
            .padtex{
                padding: 0 15px;
            }
            .btn-add-cart {
                width: calc(100% - 14px);
            }

            .prod-info .btn-buy{
                width: calc(50% - 10px);
            }
        }

       @media screen and (max-width: 768px){
            .global-compare-group{
                left: 0 !important;
            }
            .compare-pro-holder a {

                width: 30%;
            }

            .buy-button-hotline{
                font-size: 17px;
            }

            .btn-compare{
                position: absolute;
                top: 34px;
                left: 46vw;
                background: #E5172F !important;
            } 
            .global-compare-group .close-compare{
                position: absolute;
                top: 10px;
                left: 94vw;
            }  
        }
    </style>


@endpush

<?php 
    if(!Cache::has('saker') ){

        $saker = App\Models\maker::get();

       Cache::forever('saker',$saker);

    } 

    $sakers = Cache::get('saker');

    $logoSaker = $sakers->filter(function($item) use($data){
        return $item->id == $data->Maker;
    })->first();

    $check_deal =  Cache::get('deals')->where('product_id', $data->id);

    $now = \Carbon\Carbon::now();
   
    if(!empty($check_deal)){

        $check_deal =  $check_deal->all();

        if(!empty($check_deal)){
            $check_deal = reset($check_deal);
        }

        $deal_check_add = false;
        
        if(!empty($check_deal) && !empty($check_deal->deal_price) &&$check_deal->active==1){
             
            $timeDeal_star = $check_deal->start;
            $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
            $timeDeal_end = $check_deal->end;
            $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
            $timestamp = $now->diffInSeconds($timeDeal_end);


            if($now->between($check_deal->start, $check_deal->end)){
                $deal_check_add = true;
               
                $price_old = $data->Price;
                $text = '<b>MUA ONLINE GIÁ SỐC: </b>';
                $data->Price = $check_deal->deal_price;
                $percent = ceil((int)$price_old/$data->Price);
            }
        }
        
    }

    // check flashdeal 


   
    if(!cache::has('date_flash_deal')){

        $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;
        cache::put('date_flash_deal', $date_string_flash_deal, 10000);
    } 

    $date_string_flash_deal = cache::get('date_flash_deal');


    $date_flashdeal = \Carbon\Carbon::create($date_string_flash_deal);

    if($date_flashdeal->isToday()){

        $add_date = $date_string_flash_deal;
        $time1_start = \Carbon\Carbon::createFromDate($add_date.', 9:00');
        $time1 = \Carbon\Carbon::createFromDate($add_date.', 12:00');
        $time2_start = \Carbon\Carbon::createFromDate($add_date.', 12:00');
        $time2 = \Carbon\Carbon::createFromDate($add_date.', 14:00');
        $time3_start = \Carbon\Carbon::createFromDate($add_date.', 14:00');
        $time3 = \Carbon\Carbon::createFromDate($add_date.', 17:00');
        $time4_start = \Carbon\Carbon::createFromDate($add_date.', 17:00');
        $time4 = \Carbon\Carbon::createFromDate($add_date.', 22:00');

        $define = [['start'=>'9h', 'endTime'=>$time1, 'startTime'=>$time1_start], ['start'=>'12h', 'endTime'=>$time2, 'startTime'=>$time2_start], ['start'=>'14h', 'endTime'=>$time3, 'startTime'=>$time3_start], ['start'=>'17h', 'endTime'=>$time4, 'startTime'=>$time4_start]];

        foreach($define as $key => $value)

        if($now->between($value['startTime'], $value['endTime'])){

            $groups_deal = $key;

            $groups_deal = $groups_deal+1;

            $flashDeal = App\Models\flashdeal::where('product_id', $data->id)->where('flash_deal_time_id', $groups_deal)->where('active',1)->first();

            if(!empty($flashDeal)){
                $price_flash_deal = DB::table('flash_deal')->where('id', $flashDeal->flash_deal_id)->first();
                if(!empty($price_flash_deal)){
                    $deal_check_add = true;
                    $price_old = $data->Price;
                    $text = '<b>MUA ONLINE GIÁ SỐC: </b>';
                    $data->Price =  !empty($price_flash_deal->price)?$price_flash_deal->price:$flashDeal->deal_price;
                    $percent = ceil((int)$price_old/$data->Price);
                    $timestamp = $now->diffInSeconds($value['endTime']);

                }

            }

        }
    }
    // end check flashdeal


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

    
    Cache::forget('gifts_Fe_sss'.$data['id']);
    if(!Cache::has('gifts_Fe_sss'.$data['id'])){

        $gifts = gift($data['id']);


        if(empty($gifts)){

            if(!empty($groupProductId)){
                $gifts = groupGift($groupProductId);
            }   
           
            
            if(empty($gifts)){


                $gifts =[];
            }
        }
        
        Cache::put('gifts_Fe_sss'.$data['id'], $gifts,100);

    }
   
    $gift = Cache::get('gifts_Fe_sss'.$data['id']);



    if(!empty($gift)){
        $gifts = $gift['gifts'];
        $gift = $gift['gift'];

    }
    
    ?>
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/detailsfe.css') }}?ver=7">
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


    <?php 

    $mobile = 0;

    if(!empty($_SERVER['HTTP_USER_AGENT'])){
        
        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
            $mobile =1;
        }
    
    }

    ?>


    @if($mobile ==1)

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

        @if(!empty($ar_groups_info) && !empty($ar_groups_info[0]))    
        <li>
            <span>›</span>
            <a href="{{ route('details',$ar_groups_info[0]['link']) }}">{{ $ar_groups_info[0]['name'] }}</a>
            <meta property="position" content="4">
        </li>
        @endif
    </ul>
    <h1>{{ $data->Name }}</h1>

    @endif
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

                        <?php 
                            $image_product = strstr(basename($data->Image), '_');
                        ?>
                        <div class="item img-main">
                            <a href="{{ asset($data->Image) }}" data-fancybox="gallery"><img src="{{ asset($data->Image) }}" alt="{{ @$data->Name }}">

                            </a>

                            @if($data->id>4720)
                            <div class="saker">
                                <img src="{{ asset('images/saker/'.strtolower($logoSaker->maker).'.png') }}" class="lazyload">
                            </div>
                            @endif
                        </div>

                        <?php 

                            $images_products = Cache::remember('image_product_'.$data->id, 100, function() use ($data) {

                                $images = App\Models\image::where('product_id', $data->id)->select('image')->get()??'';

                                return $images;
                            
                            });

                        ?>

                        @if(isset($images_products))
                       
                        @foreach( $images_products as $image)

                        <!-- check trùng ảnh đại diện -->

                        @if(!empty($image->image) && '_'.basename($image->image) != $image_product)

                        @if( basename($image->image) != basename($data->Image) )

                        <div class="item">
                            <a href="{{ asset($image->image) }}" data-fancybox="gallery"><img src="{{ asset($image->image) }}"  alt="{{ @$data->Name }}"></a>
                        </div>
                      
                        @endif

                        <!-- end check -->
                        @endif
                        @endforeach

                        @endif
                    </div>
                </div>
            </div>
            <div class="pay mobile">
                <div class="col-12 pdetail-des">
                    <div class="clearfix"></div>
                    <div>
                        <div class="pdetail-info">
                            <p>Model: <b>{{ @$data->ProductSku  }}</b></p>
                           
                        </div>
                        <div class="scroll-box">
                           
                            <div class="pdetail-price">
                                <div class="pdetail-price-box">
                                    {!! @$text !!}
                                    <h3> {{ str_replace(',' ,'.', number_format($data->Price)) }}₫ </h3>
                                </div>

                            </div>

                            <div class="pdetail-status">
                                <div class="pdetail-stockavailable">
                                    <span>{{ $status }}</span>
                                </div>
                                @if($data_cate ===8||$data_cate ===9||$data_cate ===1)

                                <a href="tel:02473036336"><div class="buy-button-hotline nhapnhay btn">Gọi 0247.303.6336 để được giảm thêm</div></a>

                                @endif

                                @if(!empty($data->promotion))

                                <fieldset class="p-gift">
                                    <legend id="data-pricetotal" style="color: #ff0000;font-size: 18px; font-weight: bold" data-pricetotal="0">
                                        Khuyến mãi kèm theo
                                    </legend>

                                        {!! @$data->promotion !!}
                                       
                                </fieldset>
                                @endif

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


                                        <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart cartSP" onclick="addToSuport(2221)">GỌI LẠI CHO TÔI <br>(Tư vấn tận tình, chu đáo)</button>
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

                    <div id="thumb-article-gallery-0" class="item itemTab  is-show-popup scroll-content" data-gallery-id="article-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
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

            <div class="modal fade" id="modal-suport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="loader"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabels">Thông tin khách hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="tbl_list_carts" style="text-align: center;">
                                <div class="cart_col_1">
                                    <a href="{{  route('details', $data->Link)}}"><img src="{{ asset($data->Image) }}" style="width: 85px;"></a>
                                   
                                </div>
                                <div class="cart_col_2">
                                    <a href="{{  route('details', $data->Link)}}"><span class="name">{{ $data->Name }}</span></a>
                                    
                                    
                                </div>
                                
                            </div>

                            <div class="c3_col_1">
                                <form class="c3_box" id="form-subs">
                                   
                                    <div class="title_box_cart"> Thông tin khách hàng</div>
                                    <div class="item-form">
                                        <div class="option-group clearfix">
                                            <div class="step_option">
                                                <span class="st_opt st_opt_active" data-value="Anh" data-name="sex"></span><span>Anh</span>
                                            </div>
                                            <div class="step_option">
                                                <span class="st_opt" data-value="Chị" data-name="sex"></span><span>Chị</span>
                                            </div>
                                            <input type="hidden" name="sex" id="sexs" value="Nam">
                                        </div>
                                        <!--option-group-->
                                    </div>
                                    <div class="item-form">
                                        <input type="text" name="name" id="buyer_names_call" placeholder="Họ tên" >
                                    </div>
                                    <div class="item-form">
                                        <input type="text" name="phone_numbers" id="buyer_tels" value="" placeholder="Số điện thoại" >
                                    </div>
                                   
                                    <div class="modal-footer">
                                        <div  class="btn btn-primary click-sp" onclick="addCallPhone({{ $data->id }})">Gửi thông tin </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        
                                    </div>

                                </form>
                            </div>
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
            <div class="content" id="contents-scroll">
                 

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

            @if($mobile ==0)
            
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

                @if(!empty($thuonghieu[$data_cate])&& !empty($ar_groups_info))
                <li>
                    <span>›</span>
                    <a href="{{ route('details',$ar_groups_info[0]['link']) }}">{{ $ar_groups_info[0]['name'] }}</a>
                   
                </li>
                @endif
            </ul>



            <div class="box-info-name">

                <h1>{{ $data->Name }}</h1>

                
            </div>

            <br>
            <div class="box-compare">

                @if(!empty($thuonghieu[$data_cate])&& !empty($ar_groups_info))
                <span style="font-weight: bold; font-size:17px ">Thương hiệu:  <a href="{{ route('details', $ar_groups_info[0]['link']) }}">{{ str_replace($namecate->name, '',  $ar_groups_info[0]['name']) }}</a></span> 
                @endif
                &nbsp



                 <span style="font-weight: bold; font-size:17px ">Model: {{ $data->ProductSku }} </span> 
                &nbsp

                <a href="javascript:void(0)" class="compare-show" onclick="compareShow({{ $data->id }})">
                    <i class="fa-solid fa-plus"></i>
                        so sánh
                </a>
            </div>

            <hr>
             <div class="pdetail-stockavailable stock">

                <span>{{ $status }}</span>

                &nbsp 
                <a href="https://goo.gl/maps/TozxKHRZeHfrafMt9" title="#" class="adress_stock"><i class="fa fa-map-marker"></i> Địa chỉ kho hàng</a>

            </div>

           
            @if(!empty($data_cate) && $data_cate==1)

            <?php

                $cutModel1 = str_replace('UA', '', $data->ProductSku);

                $cutModel = substr(trim($cutModel1),2);

                $data_model = Cache::get('product_search');

                $relationProduct = collect($data_model)->filter(function ($item) use ($cutModel) {
                  
                    return false !== strpos($item->ProductSku, $cutModel);
                });

                $relationProduct =  $relationProduct->sortBy('Name');



            ?>
            @if($relationProduct->count()>1)
               
                <?php 

                    $size_tv = str_replace($cutModel, '', $data->ProductSku);
                   
                ?>
                
                <p class="padtex">Có <strong> {{ $relationProduct->count() }} Kích cỡ màn hình.</strong> Bạn đang chọn <strong>{{ $size_tv }} inch</strong></p>
                <div class="scrolling_inner">
                    @foreach($relationProduct->chunk(4) as $chunk)
                    <div class="box03 group desk">
                        @foreach ($chunk as $relationProducts)
                            <?php 
                                $check_deals_pd =  Cache::get('deals')->where('product_id', $relationProducts->id)->first();

                                if(!empty($check_deals_pd)){

                                    $relationProducts->Price = $check_deals_pd['deal_price'];

                                }

                            ?>

                            <a class="one_size  {{ $relationProducts->ProductSku==$data->ProductSku?'act':'' }}" href="{{ route('details', $relationProducts->Link) }}"><label class="container-detail"><span class="size-pro">{{  str_replace( $cutModel, '', $relationProducts->ProductSku)  }} inch</span><span class="price-pro">{{ str_replace(',' ,'.', number_format(@$relationProducts->Price))  }}đ</span></label></a>
                        
                        @endforeach
                       
                    </div>
                    @endforeach
                </div>
            @endif
                
            @endif

            @endif
            <div class="col-12 pdetail-des">
                <div class="clearfix"></div>
                <div>
                    <div class="pdetail-info">
                        <!-- <p>Model: <b>{{ @$data->ProductSku  }}</b></p> -->
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

                                .buy-button-hotline {
                                    text-align: center;
                                    margin-top: 1em;
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
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            @endif
                            <br>

                            @if(!empty($data->manuPrice) || !empty($price_old))

                            @if(!empty($price_old))

                                <div class="price_giaban price_market">Giá niêm yết : <span>{{str_replace(',' ,'.', number_format($price_old))}}đ </span></div>
                                <br>
                            @else    
                            <div class="price_giaban price_market">Giá hãng : <span>{{str_replace(',' ,'.', number_format($data->manuPrice))}}đ </span></div>
                            <br>
                            @endif
                            @endif 

                            

                            {!!  @$text??'<b>GIÁ ONLINE</b>' !!}
                           
                            
                            <div class="pdetail-price-box">

                                <h3>
                                    {{str_replace(',' ,'.', number_format($data->Price))  }}₫
                                </h3>

                                @if(!empty($data->manuPrice) || !empty($price_old))
                                <b>Rẻ hơn</b>

                                <?php 

                                    $discount = !empty($price_old)?round(((intval($price_old) - intval($data->Price))/intval($price_old))*100):round(((intval($data->manuPrice) - intval($data->Price))/intval($data->manuPrice))*100)
                                ?>

                                <span class="discount_percent">-{{ $discount }}%</span>
                                @endif 
                                 
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

                        <div class="clearfix"></div>
                        <div class="pdetail-status">

                            
                           
                            @if($data_cate ===8||$data_cate ===9||$data_cate ===1)

                            <a href="tel:02473036336"><div class="buy-button-hotline nhapnhay btn">Gọi 0247.303.6336 để được giảm thêm</div></a>

                            @endif

                            @if($data->limits ==1)
                            <div class="sticker buyonline"> <p><strong>Số Lượng Có Hạn</strong></p></div>
                            @endif

                            @if(!empty($data->promotion))

                            <div class="gift_pro">
                                <span class="ttl"><i class="fa-solid fa-gift"></i> Ưu đãi tặng kèm  @if(!empty($data->GiftPrice)) trị giá {{ str_replace(',' ,'.', number_format($data->GiftPrice)) }}  @endif</span>
                               
                                <div class="gift_item">
                                    <ul>
                                        <li>
                                            
                                            <div class="gift_info">
                                               {!! @$data->promotion !!}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                                    
                            
                            @endif
                        
                            @if(!empty($gift) && $data->Quantily>0 && $deal_check_add ==false  &&  $data['Price']>0)

                            <div class="gift_pro">

                                @foreach($gift as $key => $valuegift)
                               
                                <span class="ttl"><i class="fa-solid fa-gift"></i> Quà tặng @if(!empty($valuegift->price)) kèm trị giá {{ str_replace(',' ,'.', number_format($valuegift->price)) }}đ  @endif</span>
                               
                                <div class="gift_item">
                                    <ul>
                                        <li>
                                            
                                            <div class="gift_info">
                                               {{ $gifts->type ==1?'Lựa chọn 1 trong 2 sản phẩm sau':'' }}
                                                <div class="select-gift">
                                                    
                                                    @if($gifts->type ==1)<input type="checkbox" name="gift" value="{{ $valuegift->name }}" {{ $key==0?'checked':'' }}> @endif
                                                    <img src="{{ asset($valuegift->image) }}" height="30px" width="30px">

                                                        <h4>{{ $valuegift->name }}</h4>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>

                             @endif    

                            @if($data['Quantily']>0)
                            <div class="pdetail-add-to-cart add-to-cart">
                                <form class="inline">
                                    <input type="hidden" name="productId" value="19439">
                                    <!-- <div class="product-quantity">
                                        <input type="text" class="quantity-field" readonly="readonly" name="qty" value="1">
                                        </div> -->
                                    @if((int)$data['Price']>0)
                                    <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart" onclick="addToCart({{ $data->id }})">MUA NGAY <br>(Giao hàng tận nơi - Giá tốt)</button>

                                    
                                    @else
                                    <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart">LIÊN HỆ <br></button>
                                    @endif
                                </form>
                                 <button type="button" class="btn btn-lg btn-add-cart btn-add-cart redirectCart cartSP" onclick="addToSuport({{ $data->id }})">GỌI LẠI CHO TÔI <br>(Tư vấn tận tình, chu đáo)</button>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Launch demo modal
                                    </button> -->
                            </div>
                            <div class="clearfix"></div>


                            <div class="installment-purchase pdetail-installment specifications-img">
                                
                                @if((int)$data['Price']>=3000000)
                               
                                <a  class="but-tra-gop add-cart-button" href="javascript:void(0)" onclick="addCartFast({{ $data->id }})" admicro-data-event="101725" admicro-data-auto="1" admicro-data-order="false">
                                <strong>THÊM VÀO </strong>
                                <br>
                                <strong>GIỎ HÀNG</strong>
                                </a>

                                 <a target="_blank" class="but-tra-gop installments-but" href="{{ route('details', $data->Link)  }}?show=tra-gop" admicro-data-event="101725" admicro-data-auto="1" admicro-data-order="false">
                                <strong>TRẢ GÓP QUA THẺ</strong>
                                <br>
                                (Visa, Master, JCB)
                                </a>
                                @else
                                 <a target="_blank" class="add-card-buttons add-cart-button" href="javascript:void(0)" onclick="addCartFast({{ $data->id }})">
                                <strong>THÊM VÀO GIỎ HÀNG </strong>
                              
                                </a>
                                
                                @endif

                                
                                <br><br>
                                {!!  $data->Specifications  !!} 
                            </div>
                            @else

                            <div class="pdetail-add-to-cart pdetail-installment specifications-img">
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

                        Cache::forever('comment'.$data->id, $comments_id);

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
                    <p class="comment-meta"><time class="comment-time" itemprop="datePublished"><a class="comment-time-link" href="javascript:voi(0)" itemprop="url">{{ $comments->created_at->format('d/m/Y, H:i' )  }}</a></time></p>
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
                    <a href="javascript:void(0)" class="compare-show" onclick="compareShow({{ $value->id }})">
                        <i class="fa-solid fa-plus"></i>
                            so sánh
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
            Tình trạng: <span class="value txt_blue">{{ @$status }}</span> | 
        </div>
        <a id="btn-vote" class="txt_555 fl" href="javascript:;" onclick="go_comm()"> Đánh giá: </a>
        <div class=" totalRate " id="js-total-rating" style="display: inline-block;"><i class="icons icon-star star"><span></span></i><i class="icons icon-star star"><span></span></i><i class="icons icon-star star"><span></span></i><i class="icons icon-star star"><span></span></i><i class="icons icon-star star"><span></span></i></div>
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

            <a class="btn-buy txt_center cor5px buy-nows-popup but-carsp" href="javascript:void(0)">
            <i class="fa fa-phone"></i> <span class="txt_15" onclick="addToSuport({{ $data->id }})">Gọi lại cho tôi</span>
            </a>
        </div>
        @endif
        @if((int)$data->Price>=3000000)
        <div class="clear space10px credit">
           
            <a class="btn-buy txt_center cor5px"  href="{{ route('details', $data->Link)  }}?show=tra-gop" style="background: #ffde00; border-bottom: 0;">
            <i class="fa fa-shopping-cart"></i> <span class="txt_15" >Trả góp qua thẻ</span>
            </a>

            <a class="btn-buy txt_center cor5px"  href="javascript:void(0)" style="border-bottom: 0;" onclick="addCartFast({{ $data->id }})">
            <i class="fa fa-shopping-cart"></i> <span class="txt_15">Thêm vào giỏ hàng</span>
            </a>
        </div>
        @endif

         <br>

        <div>
            
            <a class="btn-buy txt_center cor5px"  href="javascript:void(0)" style="border-bottom: 0; background: #CCD0D3;
    color: #000; width: calc(100% - 15px); padding: 0;"  data-toggle="modal" data-target="#specifications">
            <i class="icondetail-thongso"></i> <span class="txt_15">Thông số kỹ thuật</span>
            </a>
        </div>
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
      
        <div class="clear"></div>
    </div>
    <!--right-->
    <div class="clear"></div>
    </div>
    <!--//prod-info-left -->

</div>
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/details.css') }}?ver=4">
@endpush
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">


    let ar_product = [];

    function compare_link() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('check-unique-cate') }}",
            data: {
                ar_product_id: JSON.stringify(ar_product),
                  
            },
            success: function(result){
                if(result == 0){

                    alert('có sản phẩm không cùng nhóm, không thể so sánh');
                }
                else{

                   
                    var link = '{{ route("so-sanh") }}?list='+ar_product+'&cate='+result;
        
                    location.href = link;
                }
               
            }
        });         
    }

    $('.scroll-content').click(function(){

        $('html, body').animate({
            scrollTop: $("#contents-scroll").offset().top
        }, 1000);
    })

    function compareShow(id) {
       
        if($(this).find('.fa-solid').hasClass('fa-check')){

            $(this).find('.fa-solid').removeClass('fa-check');

            $(this).find('.fa-solid').addClass('fa-plus');

            $(this).css('color','#59A0DA');

            index = ar_product.indexOf(id);

            if (index !== -1) {
                ar_product.splice(index, 1);
            }
        }
        else{
            $(this).css('color','red');

            $(this).find('.fa-solid').removeClass('fa-plus');

            $(this).find('.fa-solid').addClass('fa-check');

            if(ar_product.length<3){

                ar_product.push(id);
            } 
            else{
                alert('không thể thêm sản phẩm nữa');
            }    
        }

       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('compare-show') }}",
            data: {
                ar_product_id: JSON.stringify(ar_product),
                   
            },
            success: function(result){
               $('#js-compare-holder').html('');
               $('#js-compare-holder').append(result);
            }
        });         
    
        $('.global-compare-group').show();

    }

    

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
    
        $(".box01 a").fancybox({
            'hideOnContentClick': true,
             buttons : [
                'zoom',
                'download',
                'close'
              ]
        });
       
        $('.item-ss').bind('click',function(){
            $('.listcompare-click').show();
        })    
    
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

    function addToSuport() {
          $('#modal-suport').modal('show'); 
      }  
    
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
    
                $('#tbl_list_cartss').append(result);
    
                const numberCart = $('#number-product-cart').text();
    
                $('.number-cart').text(numberCart);
    
                $('#exampleModal').modal('show'); 
                $('.loader').hide();
                
            }
        });
        
    }

    function isValid(p) {
        var phoneRe = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
        var digits = p.replace(/\D/g, "");
        return phoneRe.test(digits);
    }


    function addCallPhone(id){

        if($('#buyer_names_call').val()==''){
            alert('vui lòng nhập họ tên');
        }
        else if($('#buyer_tels').val()==''){
            alert('vui lòng nhập số điện thoại')
        }
        else if(!isValid($('#buyer_tels').val())){
            alert('số điện thoại không đúng định dạng');
        }
        else{
            name = $('#buyer_names_call').val();
            phone = $('#buyer_tels').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('callphone') }}",
                data: {
                    name: name,
                    phone:phone,
                    product_id:id,
                       
                },
                success: function(result){
        
                    $('#modal-suport').modal('hide'); 

                    alert('Gửi thành công!')
                    
                }
            });
        }

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
        margin:10,
        nav:true,
        autoplay:true,
        dots:true,
       
        dotsEach:1,

        
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
        loop:false,
    
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1.5
            },
            600:{
                items:3
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
              if (h == -1){

                $('.crazy-deal-details').remove();

                $('.pdetail-price b').remove();
                $('.pdetail-price-box b').remove();
                priceChange = '{{  str_replace(',' ,'.', number_format($price_old))  }}'   ;
                $('.pdetail-price-box h3').text(priceChange);

              }



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
