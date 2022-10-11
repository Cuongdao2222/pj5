@extends('frontend.layouts.apps')

@section('content') 
    @push('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=11">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=10"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=5">
        <style type="text/css">
           /* deal*/

            .actives-click{
                color: red !important;
            }

           .sale-time-flash{
                margin-bottom: 10px;
           }
           .text-er{
                font-weight: bold;
           }

            .actives{
                background: #fff;
            }

            .titles-time{
               /* border-top: 2px solid #ff9;*/
                margin-top: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
               /* background-color: #fb0707;*/
                margin-bottom: 7px;
                display: block;
                width: 100%;
                height: 80px;
            }

            .titles-time h3 {
                margin: 0;
                display: inline-block;
                color: #000000;
                font-size: 18px;
                text-transform: uppercase;
                padding: 0 13px;
                vertical-align: -3px;
                float: left;
                /*background-color: #ffea26;*/
                padding: 5px 13px;
                border-radius: 4px;
                
                cursor: pointer;
            }


            .titles-time .cat-child {
                padding: 2px 0;
                display: inline-block;
                margin-left: 2px;
            }

            .titles-time .cat-child a {
                line-height: 36px;
                color: #000000;
                background-color: #ff9;
                padding: 11px 10px;
                border-radius: 4px;
            }

            .titles-time .cat-child li {
                float: left;
                padding-right: 8vw;
            }

            /*.titles-time .minutes{
                font-weight: normal;
                color: #000;
            }*/




            .div-title-news{
                margin-bottom: 10px;
            }
            .texts p {
                height: 50px;
                line-height: 32px !important;
                padding-left: 10px;
            }   

            .col1-big-img img{
               /* width: auto !important;*/
            }
            .col1-big-img{
                text-align: center;
            }
            .big-title-href{
                height: 100%;
            }
            .result-labels{
                /*position: absolute ;
                left: 0;*/
                margin-bottom: 10px;
            }
            .icon_sale{
                
                padding: 3px;
                border-radius: 2px;
                font-size: 10px;
                color: #000;
                position: absolute;
                left: 10px;
                bottom: 30%;
                z-index: 1;
            }

            .flash-sale .flash-product .col-flash-2 .item .desc {
                width: 100%;
            }    


           

            @media screen and (max-width: 767px) {
                .result-labels{
                    top: 43%;
                   
                } 

                .flash-sale .item .img {
                    width: 100% !important;
                }    

                .flash-sale .item img {
                    position: relative;
                    top: 50%;
                    transform: inherit;
                    width: 100% !important;
                }  

                .flash-sale .flash-product .col-flash-2 .item {
                    display: block;
                }    

                .flash-sale .flash-product .col-flash-2 .item .desc {
                    padding: 0 !important;
                    text-align: center;
                 }   

                .titles-time h3 {
                    font-size: 10px;
                   
                }     
                .text-promotion{
                    font-size: 1.2em !important;
                }

                .titles-time .cat-child li{
                    padding: 0 0.8vw !important;
                }
                .banner-outer{
                    margin-bottom: 10px
                }


            }

             @media screen and (min-width: 768px) {
                .titles-time h3 {
                    line-height: 29px;
                    margin-left: 10px;
                }  

                .flash-sale .flash-product .col-flash-2 .item .desc {
                    padding: 0;
                    
                }     

                .flash-sale .flash-product .col-flash-2 .item {

                    display: block;
                } 

                .flash-sale .flash-product .col-flash-2 .item .img {

                    width: auto;
                    height: 10vw;
                }  

               
                .result-labels{
                    top: 53%;
                   
                } 
                .homebanners{

                    height: auto;
                } 
                .homebanner{
                    height: auto;
                }   

                #sync1  .owl-item img {
                    height: 100% !important;
                    width: 100% !important;
                } 

                #sync1 .item img{
                    height: auto !important;
                }   


            }

            .banner-outer {
                height: 50px;
                position: sticky;
                top: calc(var(--banner-height-difference) * -1);
                display: flex;
                align-items: center;
                background-color: #fff;
                z-index: 1;
            }

            .banner-inner {
                height: 50px;
                position: sticky;
                margin: 0 auto;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                line-height: 1.25;
                width: 50%;
                background: #ffc75f;
                border-radius: 10px;
                border: 1px solid;
            }
            .text-promotion{
                font-size: 30px;
                font-weight: bold;
                color: #153464;
                text-transform: uppercase;
            }
        </style>

       
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
    <div class="locationbox__popup new-popup hide" id="lc_pop--sugg">
        <div class="locationbox__popup--cnt locationbox__popup--suggestion new-locale">
            <div class="flex-block">
                <i class="icon-location"></i>
                <p>Hãy chọn <b>địa chỉ cụ thể</b> để chúng tôi cung cấp <b>chính xác</b> th&#x1EDD;i gian giao h&#xE0;ng v&#xE0; t&#xEC;nh tr&#x1EA1;ng h&#xE0;ng.</p>
            </div>
            <div class="btn-block">
                <a href="javascript:;" class="btn-location" onclick="OpenLocation()"><b>Chọn địa chỉ</b></a>
                <a href="javascript:;" class="btn-location gray" onclick="SkipLocation()"><b>Đóng</b></a>
            </div>
        </div>
    </div>

    <div class="homebanner-container">
        <!-- Banner chính -->
        <aside class="homebanner">
            <div id="sync1" class="slider-banner owl-carousel homebanners">
                <div class="item">
                    <a aria-label="slide" data-cate="0" data-place="1535" href="#"><img  src="https://dienmaynguoiviet.vn/uploads/banner/1660814133_1660797773_THAY-DOI-DIEN-MAO-MOI.png"  data-src="https://dienmaynguoiviet.vn/uploads/banner/1660814133_1660797773_THAY-DOI-DIEN-MAO-MOI.png" alt="Thay diện mạo - Nhiệt tình giảm giá"  ></a>
                </div>
            
            </div>
           
        </aside>
        <!-- End -->
    </div>

    <br>

    <?php 
        $now  = Carbon\Carbon::now();
        // $now  = \Carbon\Carbon::createFromDate('30-8-2022, 11:00');

        $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;
        $date_flashdeal = \Carbon\Carbon::create($date_string_flash_deal);

        $deal = Cache::get('deals')->sortByDesc('order');
    ?>

    @if($date_flashdeal->isToday())


    <?php 
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
    ?>
    
    <section>
        <?php 
            $saleFlash = DB::table('flash_deal')->get();
        ?>

        @foreach($saleFlash as $keys => $vals)

        
        @if($now>$time1_start && $now < $time4)
        <div class="sale-time-flash">
            <div class="banner-outer">
                <div class="banner-inner responsive-wrapper">
                    <p class="text-promotion">{{ $vals->name }}</p>
                </div>
            </div>

           
            
            <!-- flash sale -->
            <div class="img-flashsale mobiles" style="width: 100%;">
                <a href="{{ route('details', 'deal') }}"><img src="{{ asset('images/template/flashsalemb.jpg') }}" style="width: 100%"></a>

            </div>


           
                <div class="title titles-time key{{ $keys }}">
                    <ul class="cat-child">
                        <?php 

                            $groups_deal = 0;
                            $k = 0;

                        ?>
                        @foreach($define as $key => $value)

                        @if($now<$value['endTime'])

                        <?php 
                            $k++;
                           
                            if($now->between($value['startTime'], $value['endTime'])){

                                $timestamp = $now->diffInSeconds($value['endTime']);
                                $hour =  floor($timestamp/3600);
                                $timestamp = floor($timestamp % 3600);
                                $minutes =floor($timestamp/60);
                                $timestamp = floor($timestamp % 60);
                                $seconds =floor($timestamp);

                                $groups_deal = $key;

                                $groups_deal+=1;


                                $flashDeal = App\Models\flashdeal::where('flash_deal_id', $vals->id)->where('flash_deal_time_id', $groups_deal)->where('active',1)->get();


                            }

                        ?>  
                        <li onclick="clickDeal({{ $vals->id }},{{ $key+1 }}, {{ $k }})" class='deal{{ $vals->id }}'>
                            <h3 class="{{  $k==1?'actives-click':'' }} active_{{ $key+1 }}">
                                <span>{{ $value['start'] }}</span>
                                <br>
                                <span>{!! $now->between($value['startTime'], $value['endTime'])?'<div class="clock"><span class="hour">0'.$hour.'</span>:<span class="minutes">'.$minutes.'</span>:<span class="second">'.$seconds.'</span></div>':'SẮP DIỄN RA' !!}</span>
                            </h3>
                        </li>
                        @endif
                        @endforeach
                        
                    </ul>
                </div>
               

              
            
                <div class="deal-view{{ $vals->id }}">
                    <div class="flash-sale" style="height: 305px;">
                        
                        <span id="banner-flash-sale">
                            <a href="{{ route('dealFe') }}">
                                <img width="256" src="{{  asset('images/background-image/Flash_Sale_Theme_256x396.jpg')}}" style="width: auto; height: 300px" alt="banner-fs">
                            </a>
                        </span>
                        <div class="flash-product nk-product-of-flash-sales">
                            <div class="col-flash col-flash-2 active">
                                <div id="sync1S" class="slider-banner owl-carousel flash-sale-banner">

                                    @foreach($flashDeal as $key => $value)

                                    <?php 
                                        $timestamp = $now->diffInSeconds($value->end);
                                        $hour =  floor($timestamp/3600);
                                        $timestamp = floor($timestamp % 3600);
                                        $minutes =floor($timestamp/60);
                                        $timestamp = floor($timestamp % 60);
                                        $seconds =floor($timestamp);
                                    ?>

                                    <div class="item">
                                        <a href="{{ route('details', $value->link) }}">
                                            <div class="img">
                                                <img width="327" src="{{ asset($value->image) }}"  data-src="{{ asset($value->image) }}" title="{{ $value->name }}">
                                            </div>
                                        </a>
                                        <div class="desc desc-deal{{$key}}">
                                            <a href="{{ route('details', $value->link) }}">
                                                <h4 class="title">{{ $value->name }}</h4>
                                                <div class="container-price">
                                                   <div>
                                                       <span class="price-old">{{ @str_replace(',' ,'.', number_format($value->price)) }}&#x20AB;</span>
                                                   </div>
                                                </div>
                                                <div style="margin-top: 11px">
                                                
                                                    <span class="price-new">{{  @str_replace(',' ,'.', number_format($vals->price)) }}&#x20AB;</span>
                                                </div>
                                                
                                            </a>
                                        </div>
                                    </div>
                                  
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
               <!--  end flash  -->
           
        </div>
        @endif 
        @endforeach
    </section>
   
    <!-- End -->
    <!-- Hiệu ứng ... rơi -->
    <!-- <div class="falling-container" aria-hidden="true">
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
        <div class="falling-item">
            ●
        </div>
    </div> -->
    <!-- End -->
    
    
     <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @if (session('success'))


        <script type="text/javascript">
            swal({ title: '{{ session("success") }}', type: 'success' });
          
        </script>
        <?php
        Session::forget('success');
        ?>

        
    @endif



    @if(!empty($deal))
    
    @push('script')

    
        <script type="text/javascript">
            


            loop = {{ $deal->count() }};

            times = [];
                      
            time = {{ $timestamp??15500 }};
            number_deal_product =10;
            //in time 
          
            setInterval(function(){
                for (var i = 0 ; i < loop; i++) {
                    run(i);
                }

                @foreach($define as $key => $value)

                runs('.key{{ $key }}');

                @endforeach
                
                
            }, 1000);

            function runs(key) {

                var hour =  $(key+' .hour').text();
                var minutes =  $(key+' .minutes').text();
                var second =  $(key+' .second').text();


                h =  parseInt(hour);
                m = parseInt(minutes);
                s = parseInt(second);
                s--;
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

                hour =  h.toString();

                minutes =  m.toString();
                
                seconds =  s.toString();
              
                let currentHour = h<10?'0'+hour:''+hour;
                let currentMinutes = m<10?'0'+minutes:''+minutes;
                let currentSeconds = s<10?'0'+seconds:''+seconds;

        
                let currentTimeStr ='<span class="hour">'+ currentHour+'</span>:<span class="minutes">'+currentMinutes+'</span>:<span class="second">'+currentSeconds+'</span>';
                $(key+' .clock').html(currentTimeStr);
            }    


            function clickDeal(flash_deal_id, id, dem) {

                // $(this).addClass('actives');

                classname =  $(this).attr('class');

                $('.deal'+flash_deal_id+' h3').removeClass('actives-click');

                $('.deal'+flash_deal_id+' .active_'+id).addClass('actives-click');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('showDealClick') }}",
                    data: {
                        product_id: id,
                        flash_deal_id:flash_deal_id,
                        key:dem,
                           
                    },
                    success: function(result){
                       // numberCart = result.find($("#number-product-cart").text());

                       $('.deal-view'+flash_deal_id).html(result);

                        var owl = $('.deal-view'+flash_deal_id+' .flash-sale-banner');
                        owl.owlCarousel({
                            loop:false,
                            margin:10,
                            nav:true,
                            dots:false,
                            autoplay:false,
                            
                            navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                            responsive:{
                                0:{
                                    items:2
                                },

                                 600:{
                                    items:2
                                },
                               
                                1000:{
                                    items:4
                                }
                            }
                        });
                    }
                });    
            }

            function run(key) {
                var hour =  $('.time'+key+' .hourss').text();
                var minutes =  $('.time'+key+' .minutess').text();
                var second =  $('.time'+key+' .secondss').text();
                h =  parseInt(hour);
                m = parseInt(minutes);
                s = parseInt(second);
                s--;
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

                 if (h < 0){
                    $('.time'+key).remove();

                    priceSet =  $('.desc-deal'+key+' .price-old').text();

                    $('.desc-deal'+key+' .price-old').css('text-decoration','none');

                    $('.desc-deal'+key+' .price-new').text(priceSet);

                  }  

                hour =  h.toString();

                minutes =  m.toString();
                
                seconds =  s.toString();
                $('.time'+key+' .hourss').text(h<10?'0'+hour:''+hour);
                $('.time'+key+' .secondss').text(s<10?'0'+seconds:''+seconds);
                $('.time'+key+' .minutess').text(m<10?'0'+minutes:''+minutes); 
            }
           
                                                                                                                                                                     
            if(window.innerWidth>768){
                $('.bar-top-lefts').show();
            } 


            $('.banner-sale').owlCarousel({
                loop:true,
                items:2.5,
                margin:10,
                nav:true,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                responsive:{
                    0:{
                        items:2.5
                    },
                    600:{
                        items:2.5
                    },
                    1000:{
                        items:5
                    }
                }
            });
           
           
            $('.homebanners').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                // dots:true,
                // dotsData: true,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
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

            $('.flash-sale-banner').owlCarousel({
                loop:false,
                margin:10,
                nav:true,
                dots:false,
                autoplay:false,
                
                navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                responsive:{
                    0:{
                        items:2
                    },

                     600:{
                        items:2
                    },
                   
                    1000:{
                        items:4
                    }
                }
            });
        </script>
        @endpush
    @endif  

    @else
    <!-- end check flashdeal theo thời gian thực -->
    <div style="text-align: center;"><h3 class="text-er">Chưa đến thời gian Deal, xin vui lòng quay lại sau</h3></div> 
    @endif 
@endsection      