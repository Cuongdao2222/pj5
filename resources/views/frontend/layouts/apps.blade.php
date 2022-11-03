

<!DOCTYPE html>
<html lang="vi-VN">
    <head>
         <?php  
            $requestcheck = \Request::route();

            if(!empty($requestcheck)){
                 $nameRoute = \Request::route()->getName();
            }
            else{
                 $nameRoute = '';
            }
           

          ?>
        <meta charset="utf-8" />
        <meta name="robots" content="index,follow" />
        @if(isset($meta))
        <title>{{ $meta->meta_title }}</title>
        <meta name="description" content="{{ $meta->meta_content }}"/>
        <meta property="og:title" content="{{ $meta->meta_title }}" />
        

        <meta property="og:description" content="{{ $meta->meta_content }}" /> 
        <meta name="keywords" content="{{ $meta->meta_key_words??'sieu thi dien may, siêu thị điện máy, mua điện máy giá rẻ, siêu thị điện máy uy tín, siêu thị điện máy trực tuyến' }}"/>
        @else
            @if($nameRoute =='sale-home'||$nameRoute =='dealFe')
            <title>Khuyến mại lớn, giảm giá mạnh tại Điện Máy Người Việt</title>
            <meta name="description" content="Hàng ngàn khuyến mại hấp dẫn và giảm giá tại Siêu Thị Điện Máy Người Việt. Liên hệ hotline 0247.303.6336 để biết thêm thông tin chi tiết"/>
            <meta property="og:title" content="Khuyến mại lớn, giảm giá mạnh tại Điện Máy Người Việt" />
            <meta property="og:description" content="Hàng ngàn khuyến mại hấp dẫn và giảm giá tại Siêu Thị Điện Máy Người Việt. Liên hệ hotline 0247.303.6336 để biết thêm thông tin chi tiết" /> 
            <meta name="keywords" content="Khuyến mại lớn, giảm giá mạnh,"/>
            @else

             <?php 

                if(!Cache::has('meta5959')){

                    $metas = App\Models\metaSeo::find(5959); 

                    Cache::put('meta5959', $metas, 100000);

                }
                
                $meta = Cache::get('meta5959');
             ?>

            <title>{{  !empty($name_cates_cate)?$name_cates_cate:$meta->meta_title }}</title>
            <meta name="description" content="{{ $meta->meta_content }}"/>
            <meta property="og:title" content="{{ $meta->meta_title }}" />
            <meta property="og:description" content="{{ $meta->meta_content }}" /> 
            <meta name="keywords" content="{{ $meta->meta_key_words??'sieu thi dien may, siêu thị điện máy, mua điện máy giá rẻ, siêu thị điện máy uy tín, siêu thị điện máy trực tuyến' }}"/>
            @endif
        @endif
        <link rel="shortcut icon" href="{{ asset('uploads/icon/favicon.ico') }}"/>
        <meta name = "google-site-verify" content = "1AH1fN3G7ygWRcOlEQWJyhginaxmT67zTMPP8wnfFD0" />
        <meta name="google-site-verification" content="P-EnxCkmnXXEDeC0FWq-rSxjbSSyy9HeimO6f2Evtyc" />
      
        <meta http-equiv="Cache-control" content="public">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php 
            $show_meta = $_GET['show']??'';
        ?>
        @if($show_meta ==''||$show_meta=='tragop-online')
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        @endif
        @if(!empty($pageCheck))
            <!-- Google Code dành cho Thẻ tiếp thị lại -->
            <!--------------------------------------------------
            Không thể liên kết thẻ tiếp thị lại với thông tin nhận dạng cá nhân hay đặt thẻ tiếp thị lại trên các trang có liên quan đến danh mục nhạy cảm. Xem thêm thông tin và hướng dẫn về cách thiết lập thẻ trên: http://google.com/ads/remarketingsetup
            --------------------------------------------------->
            <script type="text/javascript">// <![CDATA[
            var google_tag_params = {
            ecomm_prodid: '{{ @$data->id }}',
            ecomm_pagetype: 'home',
            ecomm_totalvalue: '{{ @$data->Price }}',
            dynx_itemid: '{{ @$data->ProducSku }}',
            dynx_itemid2: '{{ @$data->ProducSku }}',
            dynx_pagetype: 'home',
            dynx_totalvalue: '{{ @$data->Price }}',
            };
            // ]]></script>
            <script type="text/javascript">// <![CDATA[
            var google_conversion_id = 971664599;
            var google_custom_params = window.google_tag_params;
            var google_remarketing_only = true;
            // ]]></script>
            <script src="//www.googleadservices.com/pagead/conversion.js" type="text/javascript">// <![CDATA[

            // ]]></script>
            <noscript>
            <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/971664599/?value=0&guid=ON&script=0"/>
            </div>
            </noscript>
            <script type="application/ld+json">
              {
                "@context": "http://schema.org",
                "@type": "Product",
                "headline": "{{ @$data->Name }}",
                "datePublished": "{{ $data->created_at->format('Y-m-d') }}",
                "name": "{{ @$data->Name }}",
                "image": [
                  "{{ asset($data->Image) }}"
                ],
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "4.8",
                    "reviewCount": "10"
                  }
              }
            </script>

        @endif
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "url": "https://dienmaynguoiviet.vn",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://dienmaynguoiviet.vn/tim?key={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
        </script>
        <link rel="alternate" type="application/rss+xml" title="RSS Feed for https://dienmaynguoiviet.vn" href="/product.rss" />
        <meta property="og:image" content="{{ asset('images/template/logo.png') }}" />
        <!-- Global site tag (gtag.js) - Google Ads: 971664599 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-971664599"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'AW-971664599');
        </script>
          <!-- Event snippet for Thêm vào giỏ hàng conversion page
        In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
        <script>
        function gtag_report_conversion(url) {
          var callback = function () {
            if (typeof(url) != 'undefined') {
              window.location = url;
            }
          };
          gtag('event', 'conversion', {
              'send_to': 'AW-971664599/xg4KCICo_MYCENfZqc8D',
              'event_callback': callback
          });
          return false;
        }
        </script>
          <!-- Event snippet for Lượt mua hàng conversion page
        In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
        <script>
        function gtag_report_conversion(url) {
          var callback = function () {
            if (typeof(url) != 'undefined') {
              window.location = url;
            }
          };
          gtag('event', 'conversion', {
              'send_to': 'AW-971664599/ggYyCLij_cYCENfZqc8D',
              'transaction_id': '',
              'event_callback': callback
          });
          return false;
        }
        </script>
          <!-- Event snippet for Click đt mobile conversion page
        In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
        <script>
        function gtag_report_conversion(url) {
          var callback = function () {
            if (typeof(url) != 'undefined') {
              window.location = url;
            }
          };
          gtag('event', 'conversion', {
              'send_to': 'AW-971664599/BsqZCL6p_cYCENfZqc8D',
              'event_callback': callback
          });
          return false;
        }
        </script>

        <script>
         gtag('event', 'page_view', {
           'send_to': 'AW-971664599',
           'dynx_itemid':'',
           'dynx_pagetype':'home',
           'dynx_totalvalue':0
         });
        </script>

       
       <!--  <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=481349662401312&ev=PageView&noscript=1"
        /></noscript> -->
        <!-- End Facebook Pixel Code -->
          
         
          
          <!-- Google Tag Manager --> 
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': 
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], 
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); 
        })(window,document,'script','dataLayer','GTM-WB77XQL');</script> 
        <!-- End Google Tag Manager --> 
          
        <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async src="//www.googletagmanager.com/gtag/js?id=UA-106951419-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments)};
          gtag('js', new Date());

          gtag('config', 'UA-106951419-1');
        </script>


        <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}?ver=1"> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/apps.css') }}?ver=14">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    
        <style type="text/css">

            .category__all{
                padding: 0 !important;
                width: 100% !important;
            }

            .category{
                box-shadow: none !important;
            }

            .main-menu{
                width: 230px;
            }

            .bar-top-left {
                position: absolute !important;
                background-color: #fff;
            }
            
            .listcompare-click{
                display: none;
            }

            .category__all{
                color: #fff !important;
               
            } 

            .list-menu .category{
                width: 11%;
            }

            .compare-pro-holder a {
                display: block;
                width: 100%;
                margin-right: 35px;
                /*float: left;*/
            }
            .compare-pro-holder img{
                width: 100%;
            }

            #suggesstion-box img{
                width: 29%;
            }

            .global-compare-group{
                display: none;
            }

            .js-compare-item{
                padding: 0 10px;
            }
            #js-compare-holder img{
                margin-bottom: 10px;

            }
            .icImageCompareNew{
                background: url("{{ asset('images/background-image/icon_add_desktop.png')  }}") no-repeat top center;
                background-size: 45px 45px;
                width: 69%;
                height: 45px;
                display: block;   
                margin-bottom: 10px;

            }

            .img-compare{
                height: 140px;
                width: 140px;
                position: relative;
            }

            .add-compare-a{
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
            }

            #js-compare-holder{
                display: flex;
            }


            /*item footer*/

            .max-width {
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
                position: relative;
            }
            .phone_hotline {
                width: 100%;
                background: #f5f5f5;
                display: flex;
                justify-content: space-between;
            }
            .p_hotline_item {
                width: 33.34%;
                text-align: center;
                position: relative;
            }

            .p_hotline_item .icon_purchase, .p_hotline_item .icon_security {
                width: 70px;
                height: 70px;
                display: inline-block;
                vertical-align: middle;
                background-image: url('{{ asset('media/category/icon.png')  }}');
            }

            .p_hotline_item span {
                width: 45%;
                display: inline-block;
                vertical-align: middle;
                font-family: Arial,Tahoma,sans-serif;
                font-size: 14px;
                color: #333;
                text-align: left;
            }

            .p_hotline_item span strong {
                display: block;
                font-weight: 700;
            }

            .p_hotline_item .icon_complain {
                width: 70px;
                height: 70px;
                display: inline-block;
                vertical-align: middle;
                background-image: url('{{ asset('media/category/icon.png')  }}');
                background-position: 95.5% 14.5%;
            }

            .p_hotline_item  .icon_purchase {
                width: 70px;
                height: 70px;
                display: inline-block;
                vertical-align: middle;
                background-image: url('{{ asset('media/category/icon.png')  }}');
                background-position: 81.5% 14.5%;
            }

            .p_hotline_item .icon_security {
                width: 70px;
                height: 70px;
                display: inline-block;
                vertical-align: middle;
                background-image: url('{{ asset('media/category/icon.png')  }}');
                background-position: 99% .5%
            }
            .iconss-sp{
                width: 20px;
            }
        </style>

        <?php  
            
            if(!Cache::has('backgrounds1')) {

                $backgrounds = App\Models\background::find(1); 

                Cache::put('backgrounds1',$backgrounds,10000);

            }

            $background = Cache::get('backgrounds1');
        ?> 
        @if(!empty($background->background_image))
        <style type="text/css">
            

             body.theme-lunar-new-year {
                background-image: url('{{ asset($background->background_image)  }}');
            }    
             
        </style>
        @else

        <style type="text/css">
            

             body.theme-lunar-new-year {
                background:'#'{{ asset($background->background_image)  }};
            }  
            .danh-muc1{
                left: 0px !important;
            } 

            .hotlines{
                position:fixed; 
                z-index:9999
            }    

             @media only screen and (min-width: 768px) {
                .hotlines{
                   
                    bottom:93px; 
                    right:8px; 
                       
                }
            }

            @media only screen and (max-width: 768px) {
                  .menus-banner .strongtitle {
                    font-size: 12px !important;
                    -webkit-line-clamp: 1;
                      -webkit-box-orient: vertical;
                      overflow: hidden;
                      display: -webkit-box;
                  }  

                .p_hotline_item span {
                    width: 100%;
                    text-align: center;
                }
                .hotlines{
                    bottom:100px; 
                    right:0; 
                }  
                #myBtn-top {
                   /* bottom: 28px;
                    right: 100px*/
                    display: none !important;
                }  
                  #skw{
                    border: 1px solid #D92548;
                  }

                .btn-remove-all-compare{
                    display: none !important;

                }
                .btn-compare{
                    top: 0px !important;
                    left: 112px !important;
                    line-height: 28px !important;
                }
                .compare-add-mobile{
                    width: 100% !important;
                }

                
            }
        </style>
        @endif

        <style type="text/css">
            
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
                left: 50%;
                z-index: 999;

            }

            .tin-km{
                padding: 5px 8px;
            }

            .deal-icon{
                color: #fe0000 !important;
            }

            #ui-id-2{
                width: 100%!important;
                left: 0 !important;
                padding: 5px;
            }

            .global-compare-group {
                background: #fff;
                position: fixed;
                bottom: 0;
                left: 30%;
                width: 800px;
                -webkit-box-shadow: 3px -2px 11px 1px rgb(0 0 0 / 25%);
                box-shadow: 3px -2px 11px 1px rgb(0 0 0 / 25%);
                z-index: 9999;
                display: none;
            }

            .global-compare-group .pro-compare-holder {
                padding-right: 15px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
            }

            .global-compare-group .title {
                background: #546ce8;
                padding: 8px 12px;
            }

            .global-compare-group .compare-pro-holder {
                width: calc(100% - 200px);
            }

            .global-compare-group .btn-compare {
                width: 145px;
                line-height: 40px;
                margin-left: 55px;
                background: #546ce8;
                color: #fff;
                font-weight: 600;
                font-size: 18px;
                border-radius: 4px;
                text-align: center;
                display: block;
            }
            .text-22 p{
                margin-bottom: 0;
            }
            .submenu strong{
                margin-bottom: 5px;
            }

        </style>
        @stack('style')
        
    </head>
    <body class="theme-lunar-new-year">
        <div class="banner-media desktop">
            <div class="" data-size="1">
                <div class="item" data-background-color="#CF1F2F" data-order="1">

                    <?php 

                        if(!Cache::has('banners12')) {

                            $banners = App\Models\banners::where('option', 1)->get()->last();

                            Cache::put('banners12',$banners,10000);
                        }


                        $banner = Cache::get('banners12');
                    ?>

                    @if(!empty($banner)&& $banner->active ==1)
                    <a aria-label="slide" data-cate="0" data-place="1295" href="#"><img  src="{{ asset($banner->image) }}" alt="BF"  ></a>
                    @endif
                </div>
            </div>
            
        </div>

       
        <?php  


            $userClient = session()->get('status-login');

            if(!Cache::has('popup1') ){

                $popups = App\Models\popup::find(4);

                Cache::put('popup1', $popups,10000);
            }


            $popup = Cache::get('popup1');
            
        ?>
        <!-- popup quảng cáo  -->

        @if($popup->active==1)

        @if($popup->option ==0)

        <div id="box-promotion" class="box-promotion box-promotion-active">
            <div class="box-promotion-item" style="width: 500px;height: 500px;left: 34%;top: 23%;">
                <div class="box-banner">
                    <a href="{{ $popup->link }}" target="_blank" rel="nofollow"><img src="{{ asset( $popup->image) }}" alt="pop-up"></a>
                </div>
                <a class="box-promotion-close" href="javascript:void(0)" title="Đóng lại">x</a>
            </div>
        </div>
        @else

        @if(!empty($requestcheck)&& \Request::route()->getName() =="homeFe")
        <div id="box-promotion" class="box-promotion box-promotion-active">
            <div class="box-promotion-item" style="width: 500px;height: 500px;left: 34%;top: 23%;">
                <div class="box-banner">
                    <a href="{{ $popup->link }}" target="_blank" rel="nofollow"><img src="{{ asset( $popup->image) }}" alt="pop-up"></a>
                </div>
                <a class="box-promotion-close" href="javascript:void(0)" title="Đóng lại">[x]</a>
            </div>
        </div>

        @endif

        @endif
        
        @endif

        <header class="header   theme-lunar-new-year" data-sub="0">

            <div class="header__top desktop header-pc">
                <section>
                    <a href="{{route('homeFe')}}" class="header__logo">
                        <img src="{{ asset('images/template/logo.png') }}">   
                   
                    </a>
                   
                    <a href="tel: 02473036336" class="header__cart fas-phones">
                         <i class="fa fa-phone phones-customn" aria-hidden="true"></i>
                         <div class="div-text">
                            <span class="tel-head">024.7303.6336</span>
                            <span class="tvbhclient">Tư vấn bán hàng</span>

                            
                        </div>
                    </a>

                    <a href="https://goo.gl/maps/TozxKHRZeHfrafMt9" class="header__cart fas-phones">
                         <i class="fa fa-map-marker" aria-hidden="true"></i>
                         <div class="div-text">
                            <span class="tel-head">Xem kho hàng</span>
                            <span class="tvbhclient">Mở cửa 8h-17h</span>

                        </div>
                    </a>

                    <form  class="header__search" method="get" action="{{ route('search-product-frontend') }}">
                        <input  type="text" class="input-search" id="tags" placeholder="Bạn muốn tìm gì..." name="key" autocomplete="off" maxlength="100" required>
                        <button type="submit">
                        <i class="icon-search"></i>
                        </button>
                        <div id="search-result"></div>
                    </form>


                    <?php
                        $cart = Gloudemans\Shoppingcart\Facades\Cart::content();

                        // foreach ($cart as $key => $value) {
                        //      dd(($value->options)['gift']);
                        // }
                       

                        $number_cart = count($cart);
                       
                     ?>   
                    <a href="javascript:void(0)" class="header__cart " onclick="showToCart()" style="margin-right: -58px;">

                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:22px"></i>
                        <b id="count_shopping_cart_store"><span class="number-cart">{{ $number_cart }}</span></b>
                    </a>

                    @if(!empty($userClient)&& $userClient=='Đăng nhập thành công')

                        <a rel="nofollow"  href="javascript:void(0)">
                            <span style="color:#fff; font-size: 12px;">Xin chào</span>
                        </a>

                        <a rel="nofollow"  href="{{ route('logout-Fe') }}">
                            <span style="color:#fff; font-size: 12px;">Đăng xuất</span>
                        </a>
                    
                    @else


                    <div  class="header__cart fas-phones">
                         <i class="fa fa-user phones-customn" aria-hidden="true"></i>
                         <div class="div-text">
                            <span class="tel-head logins-modal">Đăng nhập</span>
                            <span class="tvbhclient register-form">Đăng ký</span>
                        </div>
                    </div>

                    @endif

                    <div class="fas-phones">          
                        <a href="{{ route('tin') }}" class="header__history tin-km">Tin tức khuyến mãi</a>
                        <!-- <div class="bordercol"></div> -->
                    </div>
                </section>
            </div>

            

            <div class="header__top header__top-mobile mobiles">
                <section>
                    <div class="col-xs-12" style="display: flex; height: 63px;">
                        <div class="col-6">
                            <a href="/" class="header__logo">
                                <img src="{{ asset('images/template/logo.png') }}">   
                           
                            </a>
                        </div>
                     
                       
                        <div class="col-6" style="display:flex">
                           

                            <div class="col-4 icons-heads icons-2">
                                

                               <a href="tel: 02473036336" class="header__cart ">
                                     <i class="fa fa-phone phones-customn" aria-hidden="true" style="font-size:22px"></i>
                                </a>
                            </div>

                            <div class="col-4 icons-heads icons-1">
                            
                                <a href="javascript:void(0)" class="header__cart" onclick="showToCart()" style="width: auto;">
                                    <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:22px"></i>
                                    <b id="count_shopping_cart_store"><span class="number-cart">{{ $number_cart }}</span></b>
                                </a>
                                 
                            </div>

                            <div class="col-4 icons-heads icons-3">
                                
                                <a href="{{ route('tin') }}" class="header__cart ">
                                    <i class="fa fa-newspaper" aria-hidden="true" style="font-size:22px"></i>
                                    
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-xs-12" style="padding: 15px 10px;">
                        <form  class="header__search" method="get" action="{{ route('search-product-frontend') }}">
                            <input id="skw" type="text" class="input-search" placeholder="Bạn muốn tìm gì..." name="key" autocomplete="off" maxlength="100">
                            <button type="submit">
                            <i class="icon-search"></i>
                            </button>
                            <div id="search-result"></div>
                        </form>
                    </div>    
                </section>
            </div>


            <div class="header__top desktop menu-pc">
                <div class="menu-section">
                   

                    <ul class="list-menu">

                        <!-- <li>
                            <a class="list-mn" href="{{route('dealFe')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Giảm giá đặc biệt</span>
                            </a>
                            
                        </li> -->

                        <li class="category">
    

                        <a href="#" class="category__all"><i class="fa fa-bars" aria-hidden="true"></i> Tất cả danh mục</a>
                            <div class="bar-top-left" style="display: none;">
                                <ul class="main-menu">

                                    <li data-submenu-id="submenu-0">
                                        <div class="dropdown">
                                            <i class="fa-solid fa-tags deal-icon"></i>
                                            <a href="/deal">Giảm giá đặc biệt</a>
                                        </div>
                                    </li>    

                                    <li data-submenu-id="submenu-1">
                                        <div class="dropdown">
                                          
                                            <img src="{{ asset('media/category/cat_4d485476e07e02638e8e2133cdf8f56d.png') }}" class="iconss-sp">
                                            <a href="{{route('details','ti-vi')}}">Tivi</a>
                                        </div>
                                        <div id="submenu-1" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Thương hiệu</strong>
                                                <hr>
                                                <a href="{{route('details','tivi-samsung')}}">
                                                    <h3>Tivi Samsung</h3>
                                                </a>
                                                <a href="{{route('details','tivi-lg')}}">
                                                    <h3>Tivi LG</h3>
                                                </a>
                                                <a href="{{route('details','tivi-sony')}}">
                                                    <h3>Tivi Sony</h3>
                                                </a>
                                                <a href="{{route('details','tivi-tcl')}}">
                                                    <h3>Tivi TCL</h3>
                                                </a>
                                                <a href="{{route('details','tivi-philips')}}">
                                                    <h3>Tivi Philips</h3>
                                                </a>
                                            </aside>
                                            <aside>
                                                <strong>Loại tivi</strong>
                                                <hr>
                                                <a href="{{route('details','8k')}}">
                                                    <h3>8K</h3>
                                                </a>
                                                <a href="{{route('details','tivi-4k')}}">
                                                    <h3>4K</h3>
                                                </a>
                                                <a href="{{route('details','smart-tivi')}}">
                                                    <h3>Smart tivi</h3>
                                                </a>
                                                <a href="{{route('details','tivi-led')}}">
                                                    <h3>Tivi Led</h3>
                                                </a>
                                                <a href="{{route('details','tivi-oled')}}">
                                                    <h3>Tivi OLED</h3>
                                                </a>
                                                <a href="{{route('details','tivi-qled')}}">
                                                    <h3>Tivi QLED</h3>
                                                </a>
                                                <a href="{{route('details','tivi-frame')}}">
                                                    <h3>Tivi Frame</h3>
                                                </a>
                                                <a href="{{route('details','tivi-neo-qled')}}">
                                                    <h3>Tivi Neo QLED</h3>
                                                </a>
                                            </aside>
                                            <aside>
                                                <strong>Kích cỡ tivi</strong>
                                                <hr>
                                                <a href="{{route('details','tivi-32-inches')}}">
                                                    <h3>Tivi 32 inches</h3>
                                                </a>
                                                <a href="{{route('details','tivi-43-inches')}}">
                                                    <h3>Tivi 43 inches</h3>
                                                </a>
                                                <a href="{{route('details','tivi-48-inches')}}">
                                                    <h3>Tivi 48 inches</h3>
                                                </a>
                                                <a href="{{route('details','tivi-49-inches')}}">
                                                    <h3>Tivi 49 inches</h3>
                                                </a>
                                                <a href="{{route('details','tivi-50-inches')}}">
                                                    <h3>Tivi 50 inches</h3>
                                                </a>
                                                <a href="{{route('details','tivi-55-inches')}}">
                                                    <h3>Tivi 55 inches</h3>
                                                </a>
                                                <a href="{{route('details','tivi-tu-65-inches-tro-len')}}">
                                                    <h3>Tivi từ 65 inches trở lên</h3>
                                                </a>
                                            </aside>
                                        </div>
                                    </li>
                                    <li data-submenu-id="submenu-2" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_16d7d1935af1373f80a43ad4bd87c845.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{route('details','tu-lanh')}}" class="">Tủ lạnh</a>
                                        </div>

                                        <div id="submenu-2" class="submenu" style="display: none;">
                                            <aside>
                                                
                                                <strong>Thương hiệu</strong>
                                                <hr>

                                                <a href="{{route('details','tu-lanh-hitachi')}}">
                                                    <h3>Tủ lạnh Hitachi</h3>
                                                </a>
                                                 <a href="{{route('details','tu-lanh-panasonic')}}">
                                                    <h3>Tủ lạnh Panasonic</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-samsung')}}">
                                                    <h3>Tủ lạnh Samsung</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-sharp')}}">
                                                    <h3>Tủ lạnh Sharp</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-lg')}}">
                                                    <h3>Tủ lạnh LG</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-funiki')}}">
                                                    <h3>Tủ lạnh Funiki</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-mitsubishi')}}">
                                                    <h3>Tủ lạnh Mitsubishi </h3>
                                                </a>

                                                <a href="{{route('details','tu-lanh-hitachi')}}">
                                                    <h3>Tủ lạnh Hitachi</h3>
                                                </a>
                                            </aside>
                                            <aside>
                                                <strong>Dung tích</strong>
                                                <hr>
                                                <a href="{{route('details','duoi-150-lit')}}">
                                                    <h3>Dưới 150 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-150-200-lit')}}">
                                                    <h3>Từ 150-200 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-200-300-lit')}}">
                                                    <h3>Từ 200-300 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-300-400-lit')}}">
                                                    <h3>Từ 300-400 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-400-500-lit')}}">
                                                    <h3>Từ 400-500 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-400-500-lit')}}">
                                                    <h3>Từ 400-500 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-500-600-lit')}}">
                                                    <h3>Từ 500-600 lít</h3>
                                                </a>
                                                <a href="{{route('details','tren-600-lit')}}">
                                                    <h3>Trên 600 lít</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <strong>Loại tủ</strong>
                                                <hr>
                                                <a href="{{route('details','tu-lanh-mini')}}">
                                                    <h3>Tủ lạnh mini</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-ngan-da-tren')}}">
                                                    <h3>Tủ lạnh ngăn đá trên</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-ngan-da-duoi')}}">
                                                    <h3>tủ lạnh ngăn đá dưới</h3>
                                                </a>
                                                <a href="{{route('details','tu-lanh-side-by-side')}}">
                                                    <h3>Tủ lạnh Side By Side</h3>
                                                </a>
                                            </aside>
                                        </div>
                                    </li>

                                    <li data-submenu-id="submenu-3" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_22b19c0055ddb1f48a2a6bf7b652c01f.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'may-giat') }}">Máy giặt</a>
                                        </div>

                                        <div id="submenu-3" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Kiểu giặt</strong>
                                                <hr>
                                                <a href="{{route('details','may-giat-long-ngang')}}">
                                                    <h3>Máy giặt lồng ngang</h3>
                                                </a>
                                                <a href="{{route('details','may-giat-long-dung')}}">
                                                    <h3>Máy giặt lồng đứng</h3>
                                                </a>
                                            </aside>
                                            <aside>
                                                <strong>Thương hiệu</strong>
                                                <hr>
                                                <a href="{{route('details','may-giat-electrolux')}}">
                                                    <h3>Máy giặt Electrolux</h3>
                                                </a>
                                                <a href="{{route('details','may-giat-lg')}}">
                                                    <h3>Máy giặt LG</h3>
                                                </a>
                                                <a href="{{route('details','may-giat-panasonic')}}">
                                                    <h3>Máy giặt Panasonic</h3>
                                                </a>
                                                <a href="{{route('details','may-giat-samsung')}}">
                                                    <h3>Máy giặt Samsung</h3>
                                                </a>
                                                <a href="{{route('details','may-giat-sharp')}}">
                                                    <h3>Máy giặt Sharp</h3>
                                                </a>

                                            </aside>
                                        </div>
                                    </li>

                                    <li data-submenu-id="submenu-4" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_f6c8dd5cf8f95e19e99ef874e3edc242.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'dieu-hoa') }}" class="">Điều hòa</a>
                                        </div>

                                        <div id="submenu-4" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Thương hiệu</strong>
                                                <hr>
                                                <a href="{{route('details','dieu-hoa-daikin')}}">
                                                    <h3>Điều hòa Daikin</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-panasonic')}}">
                                                    <h3>Điều hòa Panasonic</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-mitsubishi')}}">
                                                    <h3>Điều hòa Mitsubishi</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-lg')}}">
                                                    <h3>Điều hòa LG</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-sharp')}}">
                                                    <h3>Điều hòa Sharp</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-funiki')}}">
                                                    <h3>Điều hòa Funiki</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-samsung')}}">
                                                    <h3>Điều hòa Samsung</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-nagakawa')}}">
                                                    <h3>Điều hòa Nagakawa</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <strong>Tiết kiệm điện</strong>
                                                <hr>
                                               
                                                <a href="{{route('details','co-inverter')}}">
                                                    <h3>Có inverter</h3>
                                                </a>
                                                <a href="{{route('details','khong-inverter')}}">
                                                    <h3>Không inverter</h3>
                                                </a>

                                            </aside>

                                        </div>
                                    </li>

                                    <li data-submenu-id="submenu-5" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_22b19c0055ddb1f48a2a6bf7b652c01f.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'may-say-quan-ao') }}" class="">Máy sấy quần áo</a>
                                        </div>

                                        <div id="submenu-5" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Máy sấy quần áo panasonic</strong>
                                                
                                            </aside>

                                            <aside>
                                                <strong>Máy sấy quần áo LG</strong>
                                            </aside>

                                            <aside>
                                                <strong>Máy sấy quần áo Electrolux</strong>
                                            </aside>

                                            <aside>
                                                <strong>Máy sấy quần áo Samsung</strong>
                                            </aside>
                                        </div>
                                    </li>

                                    <li data-submenu-id="submenu-6" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_d8bc7e22dcd3dcc525a4f3e9c7b433bc.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'may-loc-nuoc-ao-smith') }}" class=""> A.O.Smith</a>
                                        </div>

                                        <div id="submenu-6" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Máy Lọc Nước RO-Side Stream</strong>
                                                
                                            </aside>

                                            <aside>
                                                <strong>Máy Lọc Nước Đầu Nguồn</strong>
                                            </aside>

                                            <aside>
                                                <strong>Máy Lọc Không Khí AO Smith</strong>
                                            </aside>

                                        </div>
                                    </li>

                                    <li data-submenu-id="submenu-7" class="">
                                        <div class="dropdown">
                                             <span>
                                                <img src="{{ asset('media/category/cat_a22746738a475a75211f96a98549a811.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'gia-dung') }}" class=""> Gia dụng</a>
                                        </div>

                                        <div id="submenu-7" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Sản phẩm gia dụng</strong>
                                                <hr>
                                                <a href="{{route('details','may-hut-bui')}}">
                                                    <h3>Máy hút bụi</h3>
                                                </a>
                                                <a href="{{route('details','binh-nong-lanh')}}">
                                                    <h3>Bình nước nóng</h3>
                                                </a>
                                                <a href="{{route('details','ban-la')}}">
                                                    <h3>Bàn là</h3>
                                                </a>
                                                <a href="{{route('details','may-say-toc')}}">
                                                    <h3>Máy sấy tóc</h3>
                                                </a>
                                                <a href="{{route('details','may-loc-khong-khi-samsung')}}">
                                                    <h3>Máy lọc không khí Samsung</h3>
                                                </a>
                                                <a href="{{route('details','may-loc-khong-khi-sharp')}}">
                                                    <h3>Máy lọc không khí Sharp</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <strong>Sản phẩm nhà bếp</strong>
                                                <hr>
                                                <a href="{{route('details','noi-com-dien')}}">
                                                    <h3>Nồi cơm điện</h3>
                                                </a>
                                                <a href="{{route('details','lo-vi-song')}}">
                                                    <h3>Lò vi sóng</h3>
                                                </a>
                                                <a href="{{route('details','binh-thuy-dien')}}">
                                                    <h3>Bình thủy điện</h3>
                                                </a>
                                                <a href="{{route('details','am-sieu-toc')}}">
                                                    <h3>Ấm siêu tốc</h3>
                                                </a>
                                                <a href="{{route('details','may-xay-sinh-to')}}">
                                                    <h3>Máy xay sinh tố</h3>
                                                </a>
                                                <a href="{{route('details','may-ep-hoa-qua')}}">
                                                    <h3>Máy ép hoa quả</h3>
                                                </a>
                                                <a href="{{route('details','may-xay-da-nang')}}">
                                                    <h3>Máy xay đa năng</h3>
                                                </a>
                                            </aside>
                                        </div>

                                    </li>


                                    <li data-submenu-id="submenu-8" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_f64d8213e904929e9114d7eb68ffe7e5.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'tu-dong') }}" class=""> Tủ đông</a>
                                        </div>

                                        <div id="submenu-8" class="submenu" style="display: none;">
                                            <aside>
                                               <strong>Thương hiệu</strong>
                                               <hr>
                                                <a href="{{route('details','tu-dong-sanaky')}}">
                                                    <h3>Sanaky</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <strong>Dung tích</strong>
                                                <hr>
                                                <a href="{{route('details','tu-100-200-lit')}}">
                                                    <h3>Từ 100-200 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-200-300-lit')}}">
                                                    <h3>Từ 200-300 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-300-400-lit')}}">
                                                    <h3>Từ 300-400 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-400-500-lit')}}">
                                                    <h3>Từ 400-500 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-500-600-lit')}}">
                                                    <h3>Từ 500-600 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-600-700-lit')}}">
                                                    <h3>Từ 600-700 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-700-800-lit')}}">
                                                    <h3>Từ 700-800 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-800-900-lit')}}">
                                                    <h3>Từ 800-900 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-900-1000-lit')}}">
                                                    <h3>Từ 900-1000 lít</h3>
                                                </a>
                                                <a href="{{route('details','tren-1000-lit')}}">
                                                    <h3>Trên 1000 lít</h3>
                                                </a>
                                            </aside>
                                        </div>

                                    </li>

                                    <li data-submenu-id="submenu-9" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_16d7d1935af1373f80a43ad4bd87c845.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'tu-mat') }}" class=""> Tủ mát</a>
                                        </div>

                                        <div id="submenu-9" class="submenu" style="display: none;">
                                            <aside>
                                               <strong>Thương hiệu</strong>
                                               <hr>
                                                <a href="{{route('details','tu-mat-sanaky')}}">
                                                    <h3>Sanaky</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <strong>Dung tích</strong>
                                                <hr>
                                                <a href="{{route('details','tu-100-200-lit')}}">
                                                    <h3>Từ 100-200 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-200-300-lit')}}">
                                                    <h3>Từ 200-300 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-300-400-lit')}}">
                                                    <h3>Từ 300-400 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-400-500-lit')}}">
                                                    <h3>Từ 400-500 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-500-600-lit')}}">
                                                    <h3>Từ 500-600 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-600-700-lit')}}">
                                                    <h3>Từ 600-700 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-700-800-lit')}}">
                                                    <h3>Từ 700-800 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-800-900-lit')}}">
                                                    <h3>Từ 800-900 lít</h3>
                                                </a>
                                                <a href="{{route('details','tu-900-1000-lit')}}">
                                                    <h3>Từ 900-1000 lít</h3>
                                                </a>
                                                <a href="{{route('details','tren-1000-lit')}}">
                                                    <h3>Trên 1000 lít</h3>
                                                </a>
                                            </aside>
                                        </div>

                                    </li>

                                    <li data-submenu-id="submenu-10" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_4dc6fff104da28d600d1e4e6d8dffa9c.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="#" class="">Máy cũ hàng trưng bày</a>
                                        </div>

                                        <div id="submenu-10" class="submenu" style="display: none;">
                                            <aside>
                                                <strong>Hàng thanh lý</strong>
                                                <hr>
                                                <a href="#">
                                                    <h3>Điện tử điện lạnh</h3>
                                                </a>
                                                <a href="#">
                                                    <h3>Gia dụng thanh lý</h3>
                                                </a>
                                            </aside>
                                        </div>

                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc1">
                            <a class="list-mn" href="{{route('details','ti-vi')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Tivi</span>
                            </a>
                            <div class="navmwg accessories danh-muc1" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Thương hiệu</strong>
                                        <a href="{{route('details','tivi-samsung')}}">
                                            <h3>Tivi Samsung</h3>
                                        </a>
                                        <a href="{{route('details','tivi-lg')}}">
                                            <h3>Tivi LG</h3>
                                        </a>
                                        <a href="{{route('details','tivi-sony')}}">
                                            <h3>Tivi Sony</h3>
                                        </a>
                                        <a href="{{route('details','tivi-tcl')}}">
                                            <h3>Tivi TCL</h3>
                                        </a>
                                        <a href="{{route('details','tivi-philips')}}">
                                            <h3>Tivi Philips</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Loại tivi</strong>
                                        <a href="{{route('details','8k')}}">
                                            <h3>8K</h3>
                                        </a>
                                        <a href="{{route('details','tivi-4k')}}">
                                            <h3>4K</h3>
                                        </a>
                                        <a href="{{route('details','smart-tivi')}}">
                                            <h3>Smart tivi</h3>
                                        </a>
                                        <a href="{{route('details','tivi-led')}}">
                                            <h3>Tivi Led</h3>
                                        </a>
                                        <a href="{{route('details','tivi-oled')}}">
                                            <h3>Tivi OLED</h3>
                                        </a>
                                        <a href="{{route('details','tivi-qled')}}">
                                            <h3>Tivi QLED</h3>
                                        </a>
                                        <a href="{{route('details','tivi-frame')}}">
                                            <h3>Tivi Frame</h3>
                                        </a>
                                        <a href="{{route('details','tivi-neo-qled')}}">
                                            <h3>Tivi Neo QLED</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Kích cỡ tivi</strong>
                                        <a href="{{route('details','tivi-32-inches')}}">
                                            <h3>Tivi 32 inches</h3>
                                        </a>
                                        <a href="{{route('details','tivi-43-inches')}}">
                                            <h3>Tivi 43 inches</h3>
                                        </a>
                                        <a href="{{route('details','tivi-48-inches')}}">
                                            <h3>Tivi 48 inches</h3>
                                        </a>
                                        <a href="{{route('details','tivi-49-inches')}}">
                                            <h3>Tivi 49 inches</h3>
                                        </a>
                                        <a href="{{route('details','tivi-50-inches')}}">
                                            <h3>Tivi 50 inches</h3>
                                        </a>
                                        <a href="{{route('details','tivi-55-inches')}}">
                                            <h3>Tivi 55 inches</h3>
                                        </a>
                                        <a href="{{route('details','tivi-tu-65-inches-tro-len')}}">
                                            <h3>Tivi từ 65 inches trở lên</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc2">
                            <a class="list-mn" href="{{route('details','may-giat')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Máy giặt</span>
                            </a>
                            <div class="navmwg accessories danh-muc2" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Thương hiệu</strong>
                                        <a href="{{route('details','may-giat-electrolux')}}">
                                            <h3>Máy giặt Electrolux</h3>
                                        </a>
                                        <a href="{{route('details','may-giat-lg')}}">
                                            <h3>Máy giặt LG</h3>
                                        </a>
                                        <a href="{{route('details','may-giat-panasonic')}}">
                                            <h3>Máy giặt Panasonic</h3>
                                        </a>
                                        <a href="{{route('details','may-giat-samsung')}}">
                                            <h3>Máy giặt Samsung</h3>
                                        </a>
                                        <a href="{{route('details','may-giat-sharp')}}">
                                            <h3>Máy giặt Sharp</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Kiểu giặt</strong>
                                        <a href="{{route('details','may-giat-long-ngang')}}">
                                            <h3>Máy giặt lồng ngang</h3>
                                        </a>
                                        <a href="{{route('details','may-giat-long-dung')}}">
                                            <h3>Máy giặt lồng đứng</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Khối lượng giặt</strong>
                                        <a href="{{route('details','duoi-7kg')}}">
                                            <h3>Dưới 7kg</h3>
                                        </a>
                                        <a href="{{route('details','tu-7-8kg')}}">
                                            <h3>Từ 7-8kg</h3>
                                        </a>
                                        <a href="{{route('details','tu-8-9kg')}}">
                                            <h3>Từ 8-9kg</h3>
                                        </a>
                                        <a href="{{route('details','tren-9kg')}}">
                                            <h3>Trên 9kg</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc3">
                            <a class="list-mn" href="{{route('details','tu-lanh')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Tủ lạnh</span>
                            </a>
                            <div class="navmwg accessories danh-muc3" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Thương hiệu</strong>

                                        <a href="{{route('details','tu-lanh-panasonic')}}">
                                            <h3>Tủ lạnh Panasonic</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-samsung')}}">
                                            <h3>Tủ lạnh Samsung</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-sharp')}}">
                                            <h3>Tủ lạnh Sharp</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-lg')}}">
                                            <h3>Tủ lạnh LG</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-funiki')}}">
                                            <h3>Tủ lạnh Funiki</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-mitsubishi')}}">
                                            <h3>Tủ lạnh Mitsubishi </h3>
                                        </a>

                                        <a href="{{route('details','tu-lanh-hitachi')}}">
                                            <h3>Tủ lạnh Hitachi</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Dung tích</strong>
                                        <a href="{{route('details','duoi-150-lit')}}">
                                            <h3>Dưới 150 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-150-200-lit')}}">
                                            <h3>Từ 150-200 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-200-300-lit')}}">
                                            <h3>Từ 200-300 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-300-400-lit')}}">
                                            <h3>Từ 300-400 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-400-500-lit')}}">
                                            <h3>Từ 400-500 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-400-500-lit')}}">
                                            <h3>Từ 400-500 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-500-600-lit')}}">
                                            <h3>Từ 500-600 lít</h3>
                                        </a>
                                        <a href="{{route('details','tren-600-lit')}}">
                                            <h3>Trên 600 lít</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Loại tủ</strong>
                                        <a href="{{route('details','tu-lanh-mini')}}">
                                            <h3>Tủ lạnh mini</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-ngan-da-tren')}}">
                                            <h3>Tủ lạnh ngăn đá trên</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-ngan-da-duoi')}}">
                                            <h3>tủ lạnh ngăn đá dưới</h3>
                                        </a>
                                        <a href="{{route('details','tu-lanh-side-by-side')}}">
                                            <h3>Tủ lạnh Side By Side</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc4">
                            <a class="list-mn" href="{{route('details','dieu-hoa')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Điều hòa</span>
                            </a>
                            <div class="navmwg accessories danh-muc4" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Thương hiệu</strong>
                                        <a href="{{route('details','dieu-hoa-daikin')}}">
                                            <h3>Điều hòa Daikin</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-panasonic')}}">
                                            <h3>Điều hòa Panasonic</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-mitsubishi')}}">
                                            <h3>Điều hòa Mitsubishi</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-lg')}}">
                                            <h3>Điều hòa LG</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-sharp')}}">
                                            <h3>Điều hòa Sharp</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-funiki')}}">
                                            <h3>Điều hòa Funiki</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-samsung')}}">
                                            <h3>Điều hòa Samsung</h3>
                                        </a>
                                        <a href="{{route('details','dieu-hoa-nagakawa')}}">
                                            <h3>Điều hòa Nagakawa</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Tiết kiệm điện</strong>
                                        <a href="{{route('details','dieu-hoa-tiet-kiem-dien')}}">
                                            <h3>Điều hòa tiết kiệm điện</h3>
                                        </a>
                                        
                                        <a href="{{route('details','co-inverter')}}">
                                            <h3>Có inverter</h3>
                                        </a>
                                        <a href="{{route('details','khong-inverter')}}">
                                            <h3>Không inverter</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Công suất</strong>
                                        <a href="{{route('details','1hp')}}">
                                            <h3>1HP</h3>
                                        </a>
                                        <a href="{{route('details','15hp')}}">
                                            <h3>1.5HP</h3>
                                        </a>
                                        <a href="{{route('details','2hp')}}">
                                            <h3>2HP</h3>
                                        </a>
                                        <a href="{{route('details','25hp')}}">
                                            <h3>2.5HP</h3>
                                        </a>
                                        <a href="{{route('details','3hp')}}">
                                            <h3>3HP</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc6">
                            <a class="list-mn" href="{{route('details','tu-dong')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Tủ đông</span>
                            </a>
                            <div class="navmwg accessories danh-muc6" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Thương hiệu</strong>

                                        <a href="{{route('details','tu-dong-sanaky')}}">
                                            <h3>Sanaky</h3>
                                        </a>
                                        <a href="{{route('details','kangaroo')}}">
                                            <h3>Kangaroo</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Dung tích</strong>
                                        <a href="{{route('details','tu-100-lit-200-lit')}}">
                                            <h3>Từ 100 lít - 200 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-200-lit-300-lit')}}">
                                            <h3>Từ 200 lít - 300 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-300-lit-400-lit')}}">
                                            <h3>Từ 300 lít - 400 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-400-lit-500-lit')}}">
                                            <h3>Từ 400 lít - 500 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-500-lit-600-lit')}}">
                                            <h3>Từ 500 lít - 600 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-600-lit-700-lit')}}">
                                            <h3>Từ 600 lít - 700 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-700-lit-800-lit')}}">
                                            <h3>Từ 700 lít - 800 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-800-lit-900-lit')}}">
                                            <h3>Từ 800 lít - 900 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-900-lit-1000-lit')}}">
                                            <h3>Từ 900 lít - 1000 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-1000-lit-1500-lit')}}">
                                            <h3>Từ 1000 lít - 1500 lít</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc7">
                            <a class="list-mn" href="{{route('details','tu-mat')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Tủ Mát</span>
                            </a>
                            <div class="navmwg accessories danh-muc7" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Thương hiệu</strong>
                                        <a href="{{route('details','tu-mat-sanaky')}}">
                                            <h3>Sanaky</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Dung tích</strong>
                                        <a href="{{route('details','tu-100-200-lit')}}">
                                            <h3>Từ 100-200 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-200-300-lit')}}">
                                            <h3>Từ 200-300 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-300-400-lit')}}">
                                            <h3>Từ 300-400 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-400-500-lit')}}">
                                            <h3>Từ 400-500 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-500-600-lit')}}">
                                            <h3>Từ 500-600 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-600-700-lit')}}">
                                            <h3>Từ 600-700 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-700-800-lit')}}">
                                            <h3>Từ 700-800 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-800-900-lit')}}">
                                            <h3>Từ 800-900 lít</h3>
                                        </a>
                                        <a href="{{route('details','tu-900-1000-lit')}}">
                                            <h3>Từ 900-1000 lít</h3>
                                        </a>
                                        <a href="{{route('details','tren-1000-lit')}}">
                                            <h3>Trên 1000 lít</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Tủ ướp rượu</strong>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc8">
                            <a class="list-mn" href="{{route('details','gia-dung')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Gia dụng</span>
                            </a>
                            <div class="navmwg accessories danh-muc8" style="display: none;">
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Sản phẩm gia dụng</strong>
                                        <a href="{{route('details','may-hut-bui')}}">
                                            <h3>Máy hút bụi</h3>
                                        </a>
                                        <a href="{{route('details','binh-nong-lanh')}}">
                                            <h3>Bình nước nóng</h3>
                                        </a>
                                        <a href="{{route('details','ban-la')}}">
                                            <h3>Bàn là</h3>
                                        </a>
                                        <a href="{{route('details','may-say-toc')}}">
                                            <h3>Máy sấy tóc</h3>
                                        </a>
                                        <a href="{{route('details','may-loc-khong-khi-samsung')}}">
                                            <h3>Máy lọc không khí Samsung</h3>
                                        </a>
                                        <a href="{{route('details','may-loc-khong-khi-sharp')}}">
                                            <h3>Máy lọc không khí Sharp</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Sản phẩm nhà bếp</strong>
                                        <a href="{{route('details','noi-com-dien')}}">
                                            <h3>Nồi cơm điện</h3>
                                        </a>
                                        <a href="{{route('details','lo-vi-song')}}">
                                            <h3>Lò vi sóng</h3>
                                        </a>
                                        <a href="{{route('details','binh-thuy-dien')}}">
                                            <h3>Bình thủy điện</h3>
                                        </a>
                                        <a href="{{route('details','am-sieu-toc')}}">
                                            <h3>Ấm siêu tốc</h3>
                                        </a>
                                        <a href="{{route('details','may-xay-sinh-to')}}">
                                            <h3>Máy xay sinh tố</h3>
                                        </a>
                                        <a href="{{route('details','may-ep-hoa-qua')}}">
                                            <h3>Máy ép hoa quả</h3>
                                        </a>
                                        <a href="{{route('details','may-xay-da-nang')}}">
                                            <h3>Máy xay đa năng</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="danh-muc9">
                            <a class="list-mn" href="{{route('details','may-loc-nuoc-ao-smith')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Máy lọc nước</span>
                            </a>
                            <div class="navmwg accessories danh-muc9" style="display: none;">
                            </div>
                        </li>

                        <li class="child" data-id="danh-muc9">
                            <a class="list-mn" href="{{route('details','may-say-quan-ao')}}">
                            <i class="fa-regular fa-refrigerator"></i>
                            <span>Máy sấy quần áo</span>
                            </a>
                            <div class="navmwg accessories danh-muc9" style="display: none;">
                            </div>
                        </li>
                        
                    </ul>
                </div>
                

            </div>

            
            <div class="header__main">
                <section>

                    <div class="category mobile">
                        <p class="category__txts" style="display:none">
                        <span class="menu-list">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span></p>
                       
                        <nav class="nav-list">
                            <a href="{{ route('details','ti-vi') }}">Tivi</a>
                            <a href="{{ route('details','may-giat') }}">Máy giặt</a>
                            <a href="{{ route('details','tu-lanh') }}">Tủ lạnh</a>
                            <a href="{{ route('details','dieu-hoa') }}">Điều hòa</a>
                            <a href="{{ route('details','tu-dong') }}">Tủ đông</a>
                            <a href="{{ route('details','tu-mat') }}">Tủ Mát</a>
                            <a href="{{ route('details','gia-dung') }}">Gia dụng</a>
                            <a href="{{ route('details','may-loc-nuoc') }}">Máy lọc nước</a>
                            <a href="{{ route('details','may-say-quan-ao') }}">Máy sấy quần áo</a>
                            <a href="{{ route('details','may-loc-nuoc-ao-smith') }}">A.O.Smith</a>
                            <a href="{{ route('details','may-cu-trung-bay') }}">Máy cũ, Trưng bày</a>
                            
                                                        
                            <a href="/deal" class="promotion-menu">
                                Giảm giá <br>đặc biệt
                                <span class="item__label">- 5%</span>
                            </a>
                        </nav>
                    </div>
                   
                </section>
            </div>
          
        </header>

        @yield('content')


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="loader"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông tin giỏ hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="tbl_list_cartss">
                            
                        </div>

                        <div class="c3_col_1">
                            <form class="c3_box" id="form-sub" method="post"  action="{{ route('order') }}">
                                {{ csrf_field() }}
                                <div class="title_box_cart"> Thông tin khách hàng</div>
                                <div class="item-form">
                                    <div class="option-group clearfix">
                                        <div class="step_option">
                                            <span class="st_opt st_opt_active" data-value="Anh" data-name="sex"></span><span>Anh</span>
                                        </div>
                                        <div class="step_option">
                                            <span class="st_opt" data-value="Chị" data-name="sex"></span><span>Chị</span>
                                        </div>
                                        <input type="hidden" name="sex" id="sex" value="Nam">
                                    </div>
                                    <!--option-group-->
                                </div>
                                <div class="item-form">
                                    <input type="text" name="name" id="buyer_name" placeholder="Họ tên">
                                </div>
                                <div class="item-form">
                                    <input type="text" name="phone_number" id="buyer_tel" value="" placeholder="Số điện thoại">
                                </div>
                                <div class="item-form">
                                    <input type="text" name="mail" id="buyer_email" value="" placeholder="Email">
                                </div>
                                <div class="item-form">
                                    <textarea name="address" placeholder="Địa chỉ" id="buyer_address"></textarea>
                                </div>
                                <div class="item-form" style="width: 50%;display: inline-block;color: #0083d1;">
                                    <select name="province" class="form-control" id="ship_to_province" onchange="getDistrict(this.value)">
                                        <option value="0">--Lựa chọn--</option>
                                        <option value="1">Hà nội</option>
                                        <option value="2">TP HCM</option>
                                        <option value="5">Hải Phòng</option>
                                        <option value="4">Đà Nẵng</option>
                                        <option value="6">An Giang</option>
                                        <option value="7">Bà Rịa-Vũng Tàu</option>
                                        <option value="13">Bình Dương</option>
                                        <option value="15">Bình Phước</option>
                                        <option value="16">Bình Thuận</option>
                                        <option value="14">Bình Định</option>
                                        <option value="8">Bạc Liêu</option>
                                        <option value="10">Bắc Giang</option>
                                        <option value="9">Bắc Kạn</option>
                                        <option value="11">Bắc Ninh</option>
                                        <option value="12">Bến Tre</option>
                                        <option value="18">Cao Bằng</option>
                                        <option value="17">Cà Mau</option>
                                        <option value="3">Cần Thơ</option>
                                        <option value="24">Gia Lai</option>
                                        <option value="25">Hà Giang</option>
                                        <option value="26">Hà Nam</option>
                                        <option value="27">Hà Tĩnh</option>
                                        <option value="30">Hòa Bình</option>
                                        <option value="28">Hải Dương</option>
                                        <option value="29">Hậu Giang</option>
                                        <option value="31">Hưng Yên</option>
                                        <option value="32">Khánh Hòa</option>
                                        <option value="33">Kiên Giang</option>
                                        <option value="34">Kon Tum</option>
                                        <option value="35">Lai Châu</option>
                                        <option value="38">Lào Cai</option>
                                        <option value="36">Lâm Đồng</option>
                                        <option value="37">Lạng Sơn</option>
                                        <option value="39">Long An</option>
                                        <option value="40">Nam Định</option>
                                        <option value="41">Nghệ An</option>
                                        <option value="42">Ninh Bình</option>
                                        <option value="43">Ninh Thuận</option>
                                        <option value="44">Phú Thọ</option>
                                        <option value="45">Phú Yên</option>
                                        <option value="46">Quảng Bình</option>
                                        <option value="47">Quảng Nam</option>
                                        <option value="48">Quảng Ngãi</option>
                                        <option value="49">Quảng Ninh</option>
                                        <option value="50">Quảng Trị</option>
                                        <option value="51">Sóc Trăng</option>
                                        <option value="52">Sơn La</option>
                                        <option value="53">Tây Ninh</option>
                                        <option value="56">Thanh Hóa</option>
                                        <option value="54">Thái Bình</option>
                                        <option value="55">Thái Nguyên</option>
                                        <option value="57">Thừa Thiên-Huế</option>
                                        <option value="58">Tiền Giang</option>
                                        <option value="59">Trà Vinh</option>
                                        <option value="60">Tuyên Quang</option>
                                        <option value="61">Vĩnh Long</option>
                                        <option value="62">Vĩnh Phúc</option>
                                        <option value="63">Yên Bái</option>
                                        <option value="19">Đắk Lắk</option>
                                        <option value="22">Đồng Nai</option>
                                        <option value="23">Đồng Tháp</option>
                                        <option value="21">Điện Biên</option>
                                        <option value="20">Đăk Nông</option>
                                    </select>
                                </div>
                                <div id="district-holder-login" style="width: 49%;display: inline-block;color: #0083d1;"></div>
                                <!-- <div id="ajxTaxInvoice" class="item-form">
                                    <div class="ng_ml">
                                        <input type="checkbox" onclick="showTap('pnlTaxInvoice')" name="chkTaxInvoice" id="chkTaxInvoice">
                                        <label id="bale_ml" for="chkTaxInvoice">Xuất hóa đơn công ty</label>
                                    </div>
                                    <div style="width: 100%; margin-top:10px; padding: 0px;display: none;" id="pnlTaxInvoice">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td width="120" align="left">Công ty/Tổ chức:
                                                    </td>
                                                    <td align="left">
                                                        <input type="text" id="txtTaxName" value="" size="50" name="user_info[tax_company]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="120" align="left">Địa chỉ:
                                                    </td>
                                                    <td align="left">
                                                        <input type="text" id="txtTaxAddress" value="" size="50" name="user_info[tax_address]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="120" align="left">Mã số thuế:
                                                    </td>
                                                    <td align="left">
                                                        <input type="text" id="txtTaxCode" name="user_info[tax_code]" value="">
                                                        <span class="cmt" id="txtTaxCodeView">&nbsp;</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                                <!--ajxTaxInvoice-->
                                <div class="item-form">
                                    <h4 style="font-size:15px; margin-top:20px;">Hình thức thanh toán:</h4>
                                    <table style="width:100%;">
                                        <tbody>
                                          
                                            <tr class="item-paymethod">
                                                <td><input type="radio" style="width:initial; padding:0; margin:0; height:auto;" name="pay_method" value="3" class="pay_option" id="paymethod_3" checked></td>
                                                <td>
                                                    <label for="paymethod_3">Trả tiền khi nhận hàng</label>
                                                    <div id="pay_2" style="display:none;" class="pay_content">Trả tiền khi nhận hàng</div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="clear"></div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary order1">Đặt hàng</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    
                                </div>


                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="Modal-register" tabindex="-1" role="dialog" aria-labelledby="Modal-register" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Đăng ký</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" role="form" id="registers-form-submit" action="#">
                            {{ csrf_field() }}
                            <div class="clearfix pt-3"></div>
                            <h4>Tạo tài khoản mới.</h4>
                            <hr>
                            <div class="text-danger validation-summary-valid" data-valmsg-summary="true">
                                <ul>
                                    <li style="display:none"></li>
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="Email">Địa chỉ email</label>
                                <div class="col-md-8"><input class="form-control" type="email" data-val="true" data-val-email="The Địa chỉ email field is not a valid e-mail address." data-val-required="Trường Địa chỉ email là bắt buộc." id="Emails" name="Emails"> <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="FullName">Họ và tên</label>
                                <div class="col-md-8"><input class="form-control" data-val="true" data-val-required="Trường Tên là bắt buộc." id="FullName" name="FullName"> <span class="text-danger field-validation-valid" data-valmsg-for="FullName" data-valmsg-replace="true"></span></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="Password">Mật khẩu</label>
                                <div class="col-md-8"><input class="form-control" type="password" data-val="true" data-val-length="The Mật khẩu must be at least 4 and at max 100 characters long." data-val-length-max="100" data-val-length-min="4" data-val-required="Trường Mật khẩu là bắt buộc." id="Passwords" maxlength="100" name="Passwords"> <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true" autocomplete="on"></span></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="ConfirmPassword">Xác nhận mật khẩu</label>
                                <div class="col-md-8"><input class="form-control" type="password" data-val="true" data-val-equalto="The password and confirmation password do not match." data-val-equalto-other="*.Password" id="ConfirmPassword" name="ConfirmPassword"> <span class="text-danger field-validation-valid" data-valmsg-for="ConfirmPassword" data-valmsg-replace="true" autocomplete="on"></span></div>
                            </div>

                             
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
                            
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

       <!--  Endmodal -->

       <!-- Modal -->
        <div class="modal fade" id="Modal-login" tabindex="-1" role="dialog" aria-labelledby="Modal-login" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="login-modals">Đăng nhập</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('login-Fe') }}"  id="login-forms-fe">
                            {{ csrf_field() }}

                            <h2>Đăng nhập</h2>
                            <div class="clearfix pt-3"></div>
                            <h4>Sử dụng tài khoản của bạn để đăng nhập</h4>
                            <hr>
                            <div class="text-danger validation-summary-valid" data-valmsg-summary="true">
                                <ul>
                                    <li style="display:none"></li>
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="Email">Địa chỉ email</label>
                                <div class="col-md-8"><input class="form-control" type="email"  id="email" name="email"> <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="Password">Mật khẩu</label>
                                <div class="col-md-8"><input class="form-control" type="password"  name="password"> <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span></div>
                            </div>
                            
                            <div class="form-group row">
                               <div class="modal-footer">
                                    
                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <p><a href="javascript::void(0)" class="register-forms">Đăng ký người dùng mới</a></p>


                            
                            
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

       <!--  Endmodal -->

      

    <div class="max-width">
        <div class="phone_hotline"> <a href="tel:0243.687.9145" title="Bảo Hành: 0243.687.9145" class="p_hotline_item"> <i class="icon_security"></i> <span><strong>Bảo Hành: 0243.687.9145</strong> (8h00 - 17h00)</span> </a> <a href="tel:0247.303.6336" title="Mua hàng: 0247.303.6336" class="p_hotline_item"> <i class="icon_purchase"></i> <span><strong>Mua hàng: 0247.303.6336</strong> (8h00 - 17h00)</span> </a> <a href="tel:0916917949" title="Khiếu nại:0916917949" class="p_hotline_item"> <i class="icon_complain"></i> <span><strong>Khiếu nại: 091.691.7949</strong> (8h00 - 17h00)</span> </a> </div>
    </div>
       

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-footer">
                        <h3 class="title">Thông tin</h3>
                        <ul class="footer_list-link">
                            <li>
                                <a href="{{ route('details', 'gioi-thieu') }}">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'lien-he') }}">Liên hệ</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'nha-phan-phoi-dien-may-uy-tin-chuyen-nghiep') }}">Dự án bán buôn</a>
                            </li>

                          
                            <li class="mobile">
                                <?php 

                                    $routeUri = Route::getFacadeRoot()->current();
                                ?>
                                @if(!empty($routeUri))
                                <a href="{{ Route::getFacadeRoot()->current()->uri() }}?show=pc_view">Xem bản desktop</a>
                                @endif
                            </li>
                        </ul>
                    </div>

                   
                    <div class="col-md-3 col-footer">
                        <h3 class="title">Hỗ trợ mua hàng</h3>
                        <ul class="footer_list-link">
                            <li>
                                <a href="{{ route('details','huong-dan-mua-dien-may-tra-gop-online-qua-the-tin-dung-tren-trang-web-dien-may-nguoi-viet') }}">Hướng dẫn trả góp</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'page/cach-thuc-thanh-toan') }}">Cách thức thanh toán</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'bang-gia-vat-tu-lap-dat') }}">Bảng giá vật tư lắp đặt</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-4 col-footer">
                        <h3 class="title">Chính sách</h3>
                        <ul class="footer_list-link">
                            <li>
                                <a href="/page/chinh-sach-quy-dinh-chung">Chính sách &amp; quy định chung</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'page/chinh-sach-doi-tra-hang') }}">Chính sách đổi trả sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'page/chinh-sach-bao-hanh') }}">Chính sách bảo hành</a>
                            </li>
                            <li>
                                <a href="{{ route('details', 'page/chinh-sach-van-chuyen') }}">Chính sách giao hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-footer">
                        <form>
                            <input id="email_newsletter" type="text" placeholder="Đăng ký email nhận thông tin khuyến mại">
                            <span id="now_submit">Gửi</span>
                        </form>

                        <h4 style="margin-top: 20px;margin-bottom: 10px;">Kết nối với chúng tôi</h4>
                        <a class="ft-fb" rel="nofollow" href="https://www.facebook.com/dienmaynguoiviet/"><i class="fab fa-facebook-f"></i></a>
                        <a class="ft-yt" rel="nofollow" href="https://www.youtube.com/channel/UCRVWFSZs8k81B61_hwmkMIA"><i class="fab fa-youtube"></i></a>
                        <a rel="nofollow" href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=1180"><img style="max-height: 40px" src="{{ asset('images/template/dathongbao.png') }}"></a>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <p> <b>© 2018. Công ty TNHH Thương Mại Phú Tiến. Địa chỉ: : Kho Đóng Tàu, Ngõ 683 Đường Nguyễn Khoái, Quận Hoàng
                            Mai, TP HN. GPKD số : 0102011440 do Sở Kế Hoạch và Đầu Tư TP. Hà Nội, cấp ngày 25/02/2004 </b>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <div class="hotlines">   
            <a href="tel:02473036336"><img src="{{ asset('images/template/tongdai02473036336.png') }}" alt="hotline" style="height:72px; z-index: 999;"></a>
              
            <div class="clear"></div>
              
        </div>

        <div class="global-compare-group">
            <div class="title text-22 text-white d-flex align-items-center justify-content-between font-600">
                <p>SO SÁNH SẢN PHẨM</p>
                <a href="javascript:void(0)" class="close-compare text-white fa fa-times" onclick="compare_close()"></a>
            </div>
            <div class="text-center red mt-2 text-18 font-500" id="js-alert"></div>
            <div class="pro-compare-holder">
                <div class="compare-pro-holder clearfix" id="js-compare-holder">
                   

                </div>
                <div>
                    <a href="javascript:void(0)" class="btn-compare btn-compare" onclick="compare_link()">SO SÁNH</a>
                    <br>
                    <a href="javascript:void(0)" class="btn-compare btn-remove-all-compare" onclick="compare_close()">XÓA TOÀN BỘ </a>
                </div>
                
            </div>
        </div>




        <style type="text/css">

           .zalo-chat-widget{  
                bottom: 95px!important;  
                right: 0px!important;  
            }  
           
        </style>

       <!--  <button onclick="topFunction()" id="myBtn-top" title="Go to top"><i class="fas fa-angle-up"></i></button> -->
        
        <script>
            window.dataLayer = window.dataLayer || [];
            
            dataLayer.push({ 'pageType':'Home','pagePlatform':'Web','pageStatus':'Kinh doanh'})
            
            
            
        </script>

        <?php 
            $week = Carbon\Carbon::now()->weekOfYear;
           
        ?>

        @if( $week%2===0)
        <a href="https://zalo.me/0913011888" target="_blank">
            <div style="position: fixed; bottom: 52px; left: 52px; transform: translate(0px, 0px) !important; z-index: 2147483644; border: none; visibility: visible; right: 0px; width: 60px; height: 60px;" class="zalo-chat-widget"data-welcome-message="Điện Máy Người Việt rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height="">
                <img src="https://page.widget.zalo.me/static/images/2.0/Logo.svg">
            </div>
        </a>
        @else
        <a href="https://zalo.me/0983612828" target="_blank">
            <div style="position: fixed; bottom: 28px !important; left: 52px !important; transform: translate(0px, 0px) !important; z-index: 2147483644; border: none; visibility: visible; right: 0px; width: 60px; height: 60px;" class="zalo-chat-widget"data-welcome-message="Điện Máy Người Việt rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height="">
                <img src="https://page.widget.zalo.me/static/images/2.0/Logo.svg">
            </div>
        </a>
        @endif
 
<!-- Messenger Plugin chat Code -->
   <!--  <div id="fb-root"></div> -->

    <!-- Your Plugin chat code -->
   <!--  <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "101251095983613");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script> -->

    <!-- Your SDK code -->
   <!--  <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v14.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script> -->


     <!--Start of Tawk.to Script-->
    <script src="{{asset('js/tawto.js')}}"></script>
   
    <!--End of Tawk.to Script-->



    <link rel="stylesheet" href="{{asset('css/lib/owl.carousel.min.css')}}">

 <script src="{{ asset('js/layout1.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{asset('css/lib/owl.theme.default.min.css')}}">
    <script type="text/javascript" src="{{asset('js/lib/owl.carousel.min.js')}}"></script>

  
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>

    <script src="{{asset('js/lib/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/lib/lazyload.js') }}"></script>
    <script src="{{ asset('js/lib/sweetalert2.all.min.js') }}"></script>


    @stack('script')

  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

  <script>

    function compare_close() {

        ar_product = [];

        $('.global-compare-group').hide();

        $('.compare-show .fa-solid').removeClass('fa-check')

        $('.compare-show .fa-solid').addClass('fa-plus');

        $('.compare-show').css('color','#59A0DA');
    }


    $('.loader').hide();

    $(function() {
        $("#tags").autocomplete({

            minLength: 2,
            
            source: function(request, response) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }


                });
                $.ajax({

                    url: "{{  route('sugest-click')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product:$('#tags').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        var items = data;

                        response(items);

                        $('#ui-id-1').html();

                        $('#ui-id-1').html(data);
                    
                    }
                });
            },
            html:true,
        });
    });

    $(function() {
        $("#skw").autocomplete({
            minLength: 2,
            source: function(request, response) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }


                });
                $.ajax({

                    url: "{{  route('sugest-click')}}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product:$('#skw').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        var items = data;

                        response(items);


                        $('#ui-id-2').html();

                        $('#ui-id-2').html(data);
                    
                    }
                });
            },
            html:true,
        });
    }) 

   
  
  </script>

    <script type="text/javascript">
       
         function topFunction() {
  
           $("html, body").animate({ scrollTop: 0 }, 1000);
            return false;
          
        }

    </script>

    @if($popup->option ==0)
    <script type="text/javascript">
        
        // turn off popup
        
        lazyload();

        $('.box-promotion-close').bind("click", function(){

            if ( typeof(Storage) !== "undefined") {
               
                sessionStorage.setItem('popup','1');
               
               
            } else {
                alert('Trình duyệt của bạn đã quá cũ. Hãy nâng cấp trình duyệt ngay!');
            }
            $('.box-promotion-active').hide();

        });


        if(sessionStorage.getItem('popup')){
             $('.box-promotion-active').hide();

        }

        
    </script>

    @else

    <script type="text/javascript">

    $('.box-promotion-close').bind("click", function(){

           
            $('.box-promotion-active').hide();

    });


    </script>

    @endif

    <script type="text/javascript">

    
        $('.register-forms').click(function(){
            $("#Modal-login").modal("hide");
            $("#Modal-register").modal("show");
        })

        $('.logins-modal').click(function(){
             $("#Modal-login").modal("show");


        })

        $('.register-form').click(function(){
             $("#Modal-register").modal("show");


        })
       


        // hover menu

        $(".child").mouseenter(function(){
            const child = $( this ).attr('data-id');

            $(this).css('position','relative');

           
            $('.'+child).show();
        }).mouseleave(function(){
            
            $('.navmwg').hide();
        });

        
        
       
        $('#now_submit').click(function() {
            const value = $('#email_newsletter').val();
            if(value==''){
                alert('bạn chưa nhập thông tin email');
            }
            else{
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
                {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                
                    $.ajax({
                       
                        type: 'POST',
                        url: "{{ route('getemail') }}",
                        data: {
                            email: $('#email_newsletter').val(),
                           
                               
                        },
                        success: function(result){
                            alert(result);
                        }
                    });
                    
                }
                else{
                    alert('email không đúng đinh dạng');
                }
            }
        })
        $(window).resize(function(){
            if($(window).width()<768){

                $('.bar-top-lefts').hide();
            }
         
        });


         $("#exampleModal").on("hidden.bs.modal", function () {
            $('#tbl_list_cartss').html('');
        });

        function showToCart() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('showCart') }}",
               
                success: function(result){
                  
                   // numberCart = result.find("#number-product-cart").text();

                    $('#tbl_list_cartss').append(result);

                   
                    $('#exampleModal').modal('show'); 
                    
                }
            });
            
        }

        // check sub mit

        $( "#form-sub" ).submit(function( event ) {

          
            const numberProduct =  parseInt($('#number-product-cart').text()) ;

            if($('#ship_to_province').val()==0){

                alert('vui lòng lựa chọn thành phố');
                event.preventDefault();   
            }
            else if($('#buyer_tel').val().length<10){
                alert('vui kiểm tra lại trường số điện thoai');
                event.preventDefault();  
            }
            else if($('#buyer_address').val().length==0){
                alert('vui kiểm tra lại trường địa chỉ');
                event.preventDefault(); 
            }

            else{
                if(numberProduct<=0){
                    alert('không thể mua sản phẩm vì trong giỏ hàng ko có sản phẩm')
                    event.preventDefault();
                }
               
                else{
                    var click = 0;
                    click++;

                    $('.order1').remove();
                    $('#form-sub .btn-secondary').remove();

                    $('#exampleModal .close').hide();
                    
                    $('#exampleModal .modal-footer').append('<div  class="btn btn-primary">Đang xử lý đơn hàng</div>')
                    $('.loader').show();
                    return;
                    
                }
            }

            
        });


       

        $('.menu-list .fa-bars').bind("click", function(){
            if($('.nav-list').is(":visible")){

                $('.nav-list').hide();
            }
            else{
                $('.nav-list').show();
            }

        });

        $(".st_opt").bind("click", function(){
            $('.st_opt').removeClass('st_opt_active');

            $(this).addClass('st_opt_active');

            let sex = $(this).attr('data-value');

            $('#sex').val(sex);

        });


        $(".menu-list").bind("click", function(){
            if($(".bar-top-lefts").is(":hidden")){
                $(".bar-top-lefts").show()
            }
            else{
                $(".bar-top-lefts").hide();
            }
        });  


        $().ready(function() {
             jQuery.validator.addMethod("phonenu", function (value, element) {
                if ( /^\d{3}-?\d{3}-?\d{4}$/g.test(value)) {
                    return true;
                } else {
                    return false;
                };
            }, "Invalid phone number");

            $("#registers-form-submit").validate({
                rules: {
                   
                    "FullName": {
                        required: true,
                        maxlength:150
                         
                    },

                    "Emails": {
                        required: true,
                        email: true,
                        
                    },

                    "Passwords":{
                        required:true,
                    },
                    "ConfirmPassword":{
                        required:true,
                        equalTo: "#Passwords"
                    }

                   
                },

                messages: {
                    "FullName": {
                        required: "Bắt buộc nhập Họ và tên",
                        maxlength: "Hãy nhập tối đa 150 ký tự"
                    },
                   
                    "Emails":{
                        email: "Email không đúng định dạng",
                        required: "Bắt buộc nhập Email",
                    },

                    "Passwords":{
                        required:"Bắt buộc nhập Password",
                    },
                    "ConfirmPassword":{
                        required:"Bắt buộc nhập xác nhận Password",
                        equalTo:'Xác nhận Password phải giống với Password'
                    }
                   
                }
               
            }); 

             $("#login-forms-fe").validate({
                rules: {
                   
                   

                    "email": {
                        required: true,
                        email: true,
                        
                    },

                    "password":{
                        required:true,
                    },
                   

                   
                },

                messages: {
                    
                    "email":{
                        email: "Email không đúng định dạng",
                        required: "Bắt buộc nhập Email",
                    },

                    "password":{
                        required:"Bắt buộc nhập Password",
                    },
                  
                   
                }
               
            }); 


            $('#registers-form-submit').submit(function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('register-client-fe') }}",
                    data: {
                        fullname: $('#FullName').val(),
                        password: $('#Passwords').val(),
                        email: $('#Emails').val(),
                        
                    },
                   
                    success: function(result){
                        $("#Modal-register").modal("hide");
                        alert(result);

                        
                    }
                });
            })    

            

            $("#form-sub").validate({
                rules: {
                    "name": {
                        required: true,
                        maxlength: 15
                    },
                    "phone_number": {
                        required: true,
                         phonenu: true,
                    },

                    "mail": {
                        email: true,
                        
                    },

                    "address":{
                        required:true,
                    },
                    "province":{
                        required:true,
                    }

                   
                },
                messages: {
                    "name": {
                        required: "Bắt buộc nhập Họ và tên",
                        maxlength: "Hãy nhập tối đa 15 ký tự"
                    },
                    "phone_number": {
                        required: "Bắt buộc nhập số điện thoại",
                       
                    },
                    "mail":{
                        email: "Email không đúng định dạng",
                    },

                    "address":{
                        required:"Bắt buộc nhập thông tin địa chỉ",
                    },
                    "province":{
                        required:"Bắt buộc chọn thành phố",
                    }
                   
                }
            });
        });

        
        $( ".fa-user" ).click(function(){
            if($('.client-login').is(':visible')){
                 $('.client-login').hide();
            }
            else{
                $('.client-login').show();
            }
        })

       
    
    </script>

    </body>
</html>
