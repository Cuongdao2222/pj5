@extends('frontend.layouts.apps')

@section('content') 
    @push('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=11">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=10"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=5">
        <style type="text/css">
           /* deal*/


           .sale-time-flash{
                margin-bottom: 10px;
           }

            .actives{
                background: #fff;
            }

            .titles-time{
                border-top: 2px solid #ff9;
                margin-top: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
                background-color: #fb0707;
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
                background-color: #ffea26;
                padding: 5px 13px;
                border-radius: 4px;
                line-height: 29px;
                margin-left: 10px;
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
                padding: 0 4px;
            }

            .titles-time .minutes{
                font-weight: normal;
                color: #000;
            }








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

            @media screen and (max-width: 767px) {
                .result-labels{
                    top: 43%;
                   
                }    
            }

             @media screen and (min-width: 768px) {
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

        $deal = Cache::get('deals')->sortByDesc('order');
    ?>
     <?php 
        $time1_start = Carbon\Carbon::createFromDate('26-8-2022, 9:00');
        $time1 = Carbon\Carbon::createFromDate('26-8-2022, 12:00');
        $time2_start = Carbon\Carbon::createFromDate('26-8-2022, 12:00');
        $time2 = Carbon\Carbon::createFromDate('26-8-2022, 14:00');
        $time3_start = Carbon\Carbon::createFromDate('26-8-2022, 14:00');
        $time3 = Carbon\Carbon::createFromDate('26-8-2022, 17:00');
        $time4_start = Carbon\Carbon::createFromDate('26-8-2022, 17:00');
        $time4 = Carbon\Carbon::createFromDate('26-8-2022, 22:00');
        $define = [['start'=>'9h', 'endTime'=>$time1, 'startTime'=>$time1_start], ['start'=>'12h', 'endTime'=>$time2, 'startTime'=>$time2_start], ['start'=>'14h', 'endTime'=>$time3, 'startTime'=>$time3_start], ['start'=>'17h', 'endTime'=>$time4, 'startTime'=>$time4_start]];
    ?>
    
    <section>
        <?php 
            $saleFlash = DB::table('flash_deal')->get();
        ?>

        @foreach($saleFlash as $keys => $value)

        <div class="sale-time-flash">
            <div class="banner-outer">
                <div class="banner-inner responsive-wrapper">
                    <p class="text-promotion">{{ $value->name }}</p>
                </div>
            </div>
           
            @if(!empty($deal_check) && $deal_check->count()>0 && $now->between($deal_check[0]->start, $deal_check[0]->end)||$now>$time1_start && $now < $time4)
            <!-- flash sale -->
            <div class="img-flashsale mobiles" style="width: 100%;">
                <a href="{{ route('details', 'deal') }}"><img src="{{ asset('images/template/flashsalemb.jpg') }}" style="width: 100%"></a>

            </div>
            @if($now>$time1_start && $now < $time4)
                <div class="title titles-time key{{ $keys }}">
                    <ul class="cat-child">
                        <?php 

                            $groups_deal = 0;

                        ?>
                        @foreach($define as $key => $value)

                        @if($now<$value['endTime'])

                        <?php 
                           
                            if($now->between($value['startTime'], $value['endTime'])){

                                $timestamp = $now->diffInSeconds($value['endTime']);
                                $hour =  floor($timestamp/3600);
                                $timestamp = floor($timestamp % 3600);
                                $minutes =floor($timestamp/60);
                                $timestamp = floor($timestamp % 60);
                                $seconds =floor($timestamp);

                                $groups_deal = $key+1;
                            }

                        ?>  
                        <li onclick="clickDeal({{ $key+1 }})" class=>
                            <h3>
                                <span>{{ $value['start'] }}</span>
                                <br>
                                <span>{!! $now->between($value['startTime'], $value['endTime'])?'<div class="clock"><span class="hour">0'.$hour.'</span>:<span class="minutes">'.$minutes.'</span>:<span class="second">'.$seconds.'</span></div>':'SẮP DIỄN RA' !!}</span>
                            </h3>
                        </li>
                        @endif
                        @endforeach
                        <?php 
                           
                            // $deal = Cache::get('deals')->where('flash_deal', $groups_deal)->sortByDesc('order');
                        ?>
                     
                    </ul>
                </div>
                @endif
               
                @if($deal->count()>0)
                <div class="deal-view">
                    <div class="flash-sale" style="height: 305px;">
                        
                        <span id="banner-flash-sale"><a href="{{ route('dealFe') }}">
                        <img width="256" src="{{  asset('images/background-image/Flash_Sale_Theme_256x396.jpg')}}" style="width: auto; height: 300px" alt="banner-fs">
                        </a></span>
                        <div class="flash-product nk-product-of-flash-sales">
                            <div class="col-flash col-flash-2 active">
                                <div id="sync1S" class="slider-banner owl-carousel flash-sale-banner">

                                    @foreach($deal as $key => $value)
                                   
                                    @if(!empty($value->active) && $value->active ==1 && $now->between($value->start, $value->end)||$value->order>0)

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
                                                <div class="nk-top-stickers"><span class="nk-sticker nk-new">Mới</span></div><div>
                                                        <p class="title-shock-price">Giá sốc online</p>
                                                        <span class="price-new">{{ @str_replace(',' ,'.', number_format($value->deal_price)) }}&#x20AB;</span>
                                                    </div>
                                            </div>
                                            <div class="review_product star">
                                               <p>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </p>
                                                <div class="line_break">|</div>
                                                    <div class="reviewCount">0 đánh giá</div>
                                                </div>
                                                <div class="container-timeline">
                                                <span class="timeline"><span style="width: 2%"></span></span>
                                               <!--  <p>Đã bán <span style="color: #EE1E25">2</span> / 100 sản phẩm</p> -->
                                            </div>
                                            <div style="width: 100%; height: 1px; background: #ECECEC; margin-top: 8px"></div>

                                            <!-- <div class="countdown-flash-sale">
                                                <div class="time-cd time-fl time{{ $key }}">

                                                    <span class="timestamp" style="display: none;">{{   $now->diffInSeconds($value->end) }}</span>
                                                   
                                                   
                                                    <div class="time">
                                                        <span class="hours">
                                                            <span class="hourss"> {{ $hour }}</span>
                                                            
                                                            <div style="margin-top: 2px; width:100%; height:1px; background: #FF3647"></div>
                                                            <span>Giờ</span>
                                                        </span>
                                                        <p style="font-size: 28px; line-height: 55px;font-weight: bold;color: #101010; margin: 0 7px" >:</p>

                                                        <span class="hours">
                                                            <span class="minutess">{{ $minutes }}</span>
                                                            <div style="margin-top: 2px; width:100%; height:1px; background: #FF3647"></div>
                                                            <span>phút</span>
                                                        </span>
                                                        <p style="font-size: 28px; line-height: 55px;font-weight: bold;color: #101010; margin: 0 7px">:</p>
                                                          <span class="hours">
                                                            <span class="secondss"> {{ $seconds }}</span>
                                                            <div style="margin-top: 2px; width:100%; height:1px; background: #FF3647"></div>
                                                            <span>giây</span>
                                                        </span>
                                                       
                                                      
                                                    </div>
                                                </div>
                                            </div> -->

                                          </a>
                                        </div>
                                    </div>

                                    @endif

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
               <!--  end flash  -->
            @endif 
        </div>
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
                      
            time = {{ $timestamp }};
            number_deal_product =10;
            //in time 
          
            setInterval(function(){
                for (var i = 0 ; i < loop; i++) {
                    run(i);
                }
                runs();
                
            }, 1000);

           

        
            function runs() {

                var hour =  $('.key0 .hour').text();
                var minutes =  $('.key0 .minutes').text();
                var second =  $('.key0 .second').text();


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
                $('.key0 .clock').html(currentTimeStr);
               
            }    


            function clickDeal(id) {

                $(this).addClass('actives');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('showDealClick') }}",
                    data: {
                        product_id: id
                           
                    },
                    success: function(result){
                       // numberCart = result.find($("#number-product-cart").text());

                       $('.deal-view').html('');

                       $('.deal-view').html(result);

                        var owl = $(".flash-sale-banner");
                        owl.owlCarousel({
                            loop:false,
                            margin:10,
                            nav:true,
                            dots:false,
                            autoplay:false,
                            
                            navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                            responsive:{
                                0:{
                                    items:1
                                },

                                 600:{
                                    items:2
                                },
                               
                                1000:{
                                    items:2
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
                        items:1
                    },

                     600:{
                        items:2
                    },
                   
                    1000:{
                        items:2
                    }
                }
            });
        </script>
        @endpush
    @endif    
@endsection      