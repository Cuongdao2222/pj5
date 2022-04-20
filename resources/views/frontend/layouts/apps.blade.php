

<!DOCTYPE html>
<html lang="vi-VN">
    <head>
        <meta charset="utf-8" />
       
         
        @if(\Request::route()->getName()=='details') 



        @if(isset($meta))


        <title>{{ $meta->meta_title }}</title>
        <meta name="description" content="{{ $meta->meta_content }}"/>
        <meta property="og:title" content="{{ $meta->meta_title }}" />
        <meta property="og:description" content="{{ $meta->meta_content }}" /> 
        <meta name="keywords" content="{{ $meta->meta_keywords??'sieu thi dien may, siêu thị điện máy, mua điện máy giá rẻ, siêu thị điện máy uy tín, siêu thị điện máy trực tuyến' }}"/>

        @endif
        @else
        <title>sieu thi dien may, siêu thị điện máy, mua điện máy giá rẻ, siêu thị điện máy uy tín, siêu thị điện máy trực tuyến</title>

        <meta name="description" content="Siêu thị Điện Máy Người Việt mua sắm thiết bị điện tử điện lạnh, gia dụng, máy lọc nước chính hãng giá rẻ. Nhiều ưu đãi, giao và lắp đặt miễn phí."/>

         <meta property="og:title" content="Điện Máy Người Việt - Mua sắm điện máy chính hãng giá rẻ" />
        <meta property="og:description" content="Siêu thị Điện Máy Người Việt mua sắm thiết bị điện tử điện lạnh, gia dụng, máy lọc nước chính hãng giá rẻ. Nhiều ưu đãi, giao và lắp đặt miễn phí." /> 

        <meta name="keywords" content="sieu thi dien may, siêu thị điện máy, mua điện máy giá rẻ, siêu thị điện máy uy tín, siêu thị điện máy trực tuyến"/>
        @endif
        
        <meta http-equiv="cache-control" content="no-cache" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php 

            $show_meta = $_GET['show']??'';

        ?>

        @if($show_meta =='')
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

        @endif



        <link rel="shortcut icon" href="https://dienmaynguoiviet.vn/template/dienmaynguoiviet/images/favicon.ico"/>
        <meta name="robots" content="index,follow" />
      
        <meta name="keywords" content="sieu thi dien may, siêu thị điện máy, mua điện máy giá rẻ, siêu thị điện máy uy tín, siêu thị điện máy trực tuyến"/>
        
        <link rel="alternate" type="application/rss+xml" title="RSS Feed for https://dienmaynguoiviet.vn" href="/product.rss" />
      
          
        <meta property="og:image" content="https://dienmaynguoiviet.vn/media/banner/logo_logo.png" />


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

        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '481349662401312');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=481349662401312&ev=PageView&noscript=1"
        /></noscript>
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"> 
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style type="text/css">
            .product_list_cart {
            display: flex;
            /*padding: 10px;*/
            margin-bottom: 20px;
        }

        .menu-pc{
            background: #fed100 !important;
        }

        .header-pc {
            background-color: #187A43 !important;
        }

        /*menu top*/
        .header__top .list-menu{
            color: #000;
            line-height: 16px;
            width: 100%;
            display: flex;
            padding: 0;
            height: 43px;
            align-items: center;
            position: relative;
        } 

        .menu-section span{
            font-weight: bold;
        }
        .list-mn{
            color: #000;
            line-height: 16px;
            width: 124px;
            display: flex;
            /*padding: 0 24px;*/
            height: 43px;
            align-items: center;
            position: relative;
        }
        .header__top .list-menu li i {
            margin-right: 5px;
        }


        .child span::before {
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #333;
            content: '';
            position: absolute;
            top: 19px;
            right: 0;
        }

      

        .product_list_cart .cart_col_3 {
            width: 36%;
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .modal-content{
            width: 100%;
        }


        .product_list_cart .col_price {
            color: #c10017;
        }
        .header__logo img{
            height: 66px !important;
        }

       



       

        .product_list_cart .col_input input, .product_list_cart .col_input a {
            width: 35px;
            height: 30px;
            text-align: center;
            display: inline-block;
            border: 1px solid #ccc;
            line-height: 30px;
            float: right;
            margin-right: -1px;
            background-color: transparent;
        }
        .cart_col_1{
            width: 20%;
        }  
        .total-cart-price, .cart-foot span{
            color: #c10017;
            font-weight: bold;
        }

        .ng_ml {
            position: relative;
            margin-bottom: 10px;
        }

        .ng_ml label {
            padding-left: 20px;
            cursor: pointer;
        }

        .ng_ml .active:before {
            background-color: #549ae6;
            border: 1px solid #549ae6;
        }

        .ng_ml label:before {
            content: "\f00c";
            font-weight: 900;
            font-family: Font Awesome\ 5 Free;
            max-width: 16px;
            width: 100%;
            height: 16px;
            line-height: 14px;
            border: 1px solid #777777;
            text-align: center;
            border-radius: 3px;
            color: #fff;
            vertical-align: 1px;
            margin-right: 5px;
            position: absolute;
            left: 0;
        }

        .cart-foot {
            padding: 0 10px 20px;
            border-bottom: 1px solid #a4a4a4;
            margin-bottom: 10px;
            padding-top: 20px;
            border-top: 1px solid #e1e1e1;
        }

        .btn-add-cart {
            margin-top: 10px;
            color: #fff;
            font-size: 14px;
            padding: 8px 5px;
            line-height: 18px;
            width: 100%;
            border-radius: 5px;
            display: block;
            text-align: center;
            cursor: pointer;
            background: #e11b1e;
            background: -webkit-linear-gradient(#f52f32,#e11b1e);
            background: -o-linear-gradient(#f52f32,#e11b1e);
            background: -moz-linear-gradient(#f52f32,#e11b1e);
            background: linear-gradient(#f52f32,#e11b1e);
            border: solid 1px #e11b1e;
            }

            .installment-purchase a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            padding: 8px 5px;
            line-height: 18px;
            width: 49%;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            background: #ffde00;
            }
            .add-to-cart {
            margin-top: 10px;
            margin-bottom: 10px;
            }

            .prod-info h1 {
                font-size: 20px;
                font-weight: 600;
            }
            .menu-section{

                width: 100%;
                max-width: 1200px;
                margin: auto;


            }


            .prod-info input{
                width: 50px;
                height: 37px;
                text-align: center;
                border: 1px solid #ddd;
                margin: 0;
                padding: 0;
            }

            .prod-info .btn-buy{
                display: inline-block;
                height: 35px;
                line-height: 35px;
                padding: 0 10px 0 10px;
                color: #fff;
                border-bottom: 2px solid #a80000;
                background-color: #fc3f3f;
                background-image: -moz-linear-gradient(center top , #fc3f3f, #d91c1c);
                background-image: -webkit-linear-gradient(top,#fc3f3f,#d91c1c);
            }

            .c3_box .title_box_cart {
                font-weight: 500;
                font-size: 20px;
                padding: 8px 15px;
            }

            .c3_box .item-form {
                padding: 5px 15px;
            }

            .option-group .step_option {
                float: left;
                cursor: pointer;
                text-align: left;
                margin-bottom: 0px;
                width: auto!important;
                margin-right: 25px;
              
            }

            .st_opt {
                display: block;
                width: 16px;
                height: 16px;
                cursor: pointer;
                float: left;
                border: 1px solid #b2b2b2;
                margin-right: 10px;
                border-radius: 50%;
            }

            .st_opt_active {
                background: #0e76bd;
            }

            .c3_box input {
                display: block;
                padding: 9px 0;
                height: 35px;
                border: 1px solid #d9d9d9;
                border-radius: 4px;
                margin: 10px 0 5px;
                text-indent: 10px;
                width: 100%;
            }

            .c3_box textarea {
                display: block;
                padding: 9px 0;
                height: 105px;
                border: 1px solid #d9d9d9;
                border-radius: 4px;
                margin: 10px 0 5px;
                text-indent: 10px;
                width: 100%;
                outline: none;
            }

            .ng_ml input {
                position: absolute;
               /* height: 100%;
                padding: 0;
                margin: 0;*/
                visibility: hidden;
            }

            #form-sub label.error{
                display: inline-block !important;
                opacity: 1 !important;
            }

            #count_shopping_cart_store {
                position: absolute;
                top: -5px;
                right: 52px;
                color: #fff;
                background-color: #fe0000;
                height: 18px;
                line-height: 18px;
                width: 18px;
                border-radius: 100%;
                text-align: center;
            }
            .header__cart{
                position: relative;
            }
            .cart_col_2{
                width: 44%;
            }

            footer .col-footer h3 {
                text-transform: uppercase;
                font-size: 16px;
                color: #424242;
                font-weight: bold;
                margin-top: 0;
                margin-bottom: 15px;
            }

            footer .col-footer ul li {
                margin-bottom: 8px;
                font-weight: bold;
            }

            .col-footer #now_submit {
                width: 60px;
                line-height: 40px;
                background-color: #fe0000;
                display: inline-block;
                text-align: center;
                border-radius: 1px;
                color: #fff;
                cursor: pointer;
            }

            .col-footer #email_newsletter {
                height: 40px;
                padding: 5px;
                
            }

            .footer .row{
                margin-top: 30px;
            }
            .navmwg  .PKCH strong a {
                display: initial;
                text-transform: initial;
                color: #4a90e2;
            }

            .navmwg .TBNTM {
                width: 250px;
                margin-bottom: 10px;
                padding-top: 10px;
            }

           /* .list-menu>li:hover, .main-menu>li.active {
                background-color: #fff;
            }*/
          /*  phần responsive*/

            @media screen and (max-width: 776px){
                .box-promotion-active{
                    display: none !important;
                }
                .header__top section{
                    display: block !important;
                }
                .desktop{
                    display: none;

                }
                .submenu{
                    display: none !important;
                }
                .header__top-mobile .header__logo{
                    width: 100%;
                }

                .header__top-mobile img{

                    width: 100%;

                } 
                .item-label{
                    display: none;
                }

                .theme-lunar-new-year .footer::after {
                    width: auto !important;

                 }   
                .header__main section{
                    display: block !important;
                }

                .header__main .category{
                    width: auto;
                }

                .bar-top-lefts {
                    width: 100% !important;
                }    
                .preorder-hot{
                    display: none !important;
                }

                .theme-lunar-new-year .box-common .box-common__tab {
                    padding: 0 !important;
                }    
                .box-common__content{
                    overflow: hidden !important;
                }
                .header__logo{
                    padding: 0 !important;
                }
                body{
                   min-width: auto !important;
                }
                .header__cart{
                    border:0 !important;
                }    

                .all-icons-head{
                    height: 50px;
                    margin: 0;
                    margin-left: 0 !important;
                }
                .icons-heads{
                    line-height: 50px;
                }
                .icons-1{
                    text-align: left;
                }

                .icons-2{
                    text-align: center;
                }

                .icons-3{
                    text-align: right;
                }

                #count_shopping_cart_store {

                    top: -6px;
                    right: 0;

                }  

                .bar-top-lefts {
                    position: sticky !important;
                }  
                .menu-list{
                    margin-left: 10px;
                    font-size: 27px;
                }

                .nav-list {
                    display: flex;
                    flex-wrap: wrap;
                }

                .nav-list a {
                    align-items: center;
                    border: 1px solid #e0e0e0;
                    border-radius: 4px;
                    color: #333;
                    display: flex;
                    justify-content: center;
                    font-size: 12px;
                    line-height: 16px;
                    min-height: 40px;
                    margin: 10px 0px 5px 15px;
                    padding: 4px 0;
                     text-align: center; 
                    width: calc(20% - 0px);

                }
                .fa-chevron-right{
                    position: absolute;
                    top: 50%;
                    right: 0;
                }

                .fa-chevron-left{
                    position: absolute;
                    top: 50%;
                    
                }
                .nav-list a span.item__label {
                    background-color: #f51212;
                    border-radius: 3px;
                    color: #fff;
                    font-size: 9px;
                    font-weight: normal;
                    position: absolute;
                    padding: 0 3px;
                    right: -2px;
                    top: 0;
                    line-height: 11px;
                }
                .promotion-menu{
                    position: relative;
                }
                .category {
                    width: 100% !important;
                }  

                .list-menu li{
                    width: 100px;
                }  


            }

           
           
            @media screen and (min-width: 777px){
                .mobiles{
                    display: none;
                }
                .div-text{
                    font-size: 10px;
                    line-height: 10px;
                }
                .phones-customn{
                    font-size: 20px;
                    line-height: 30px;
                }

                .media-slider img{
                    width: 100% !important;
                    height: 44px !important;
                }

                .media-slider {
                    height: 44px;
                }  

                .banner-media img {
                    
                    width: 100%;
                }  
               
            }


           
        </style>


        <?php  $background = App\Models\background::find(1); ?> 
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
        </style>
        @endif

        @stack('style')
        
    </head>
    <body class="theme-lunar-new-year">
        <div class="banner-media desktop">
            <div class="" data-size="1">
                <div class="item" data-background-color="#CF1F2F" data-order="1">
                    <a aria-label="slide" data-cate="0" data-place="1295" href="#"><img  src="{{ asset('images/background-image/banner-top.jpg') }}" alt="BF"  ></a>
                </div>
            </div>
            <style>
                .banner-media{
                background-color: #CF1F2F;
                width: 100%;
                }



                .header__top-mobile section{
                    display: block;
                }

                .header__top-mobile .header__search{
                    width: auto;
                }

                .header__top-mobile .header__search input{
                    border-radius: 0;
                }

                .header__history{
                    width: auto !important;
                }

                 /*ẩn icon hổ*/
                .theme-lunar-new-year .footer::before{
                    display: none;
                }

                .theme-lunar-new-year .footer::after{
                    display: none;
                }
                .col-footer #email_newsletter {
                   
                    width: 183px !important;
                }

                .menu-pc{
                    background: #fed100;
                }


                .navmwg{
                    display: none;
                    position: absolute;
                    background: #fff;
                    top: 43px;
                    width: 770px;
                    border-radius: 4px;
                    padding: 10px;
                    z-index: 10;
                    border: 1px solid #eee;
                    left: 0;
                }

                .navmwg .sub-cate {
                    width: 67%;
                    display: flex;
                    flex-wrap: wrap;
                }

                .navmwg div {
                    width: 33%;
                    float: left;
                    margin-bottom: 10px;
                }

                .navmwg .sub-cate>div {
                    width: 50%;
                }

                .navmwg .TBLT {
                    width: 250px;
                    margin-bottom: 10px;
                }

                .navmwg strong {
                    text-transform: uppercase;
                    border-bottom: 1px solid #eee;
                    font-size: 13px;
                    padding-bottom: 5px;
                    color: #333;
                }

                

                .navmwg {
                    position: absolute;
                    background: #fff;
                    top: 43px;
                    width: 770px;
                    border-radius: 4px;
                    padding: 10px;
                    z-index: 10;
                    border: 1px solid #eee;
                    left: 0;
                }

                .navmwg div {
                    width: 33%;
                    float: left;
                    margin-bottom: 10px;
                }

                .navmwg div a {
                    display: block;
                    padding: 10px 5px 0 0;
                    color: #000;
                    font-size: 11px;
                    position: relative;
                }

                .navmwg strong {
                    text-transform: uppercase;
                    border-bottom: 1px solid #eee;
                    font-size: 13px;
                    padding-bottom: 5px;
                    color: #333;
                }
                .fas-phones{
                    display: flex;
                }
                .tel-head{
                    margin-bottom: 5px;

                }
                .tvbhclient{
                    width: 100px;
                }
                /*.header-pc{
                    height: 43px;
                }*/

                .header-pc section{
                    height: 64px;
                }

                .header__logo{
                    width: 394px;
                    height: 64px;
                }

                /*box quang cao slider*/
                .box-promotion-item{
                    position: absolute;
                    z-index: 999;
                }

                .box-promotion {
                    background: transparent url({{ asset('images/css/fancybox_overlay.png')  }}) repeat scroll 0 0;
                    display: block;
                    left: 0;
                    overflow: hidden;
                    position: absolute;
                    top: 0;
                    z-index: 9999;
                }

                .box-promotion-active {
                    bottom: 0;
                    display: block;
                    position: fixed;
                    right: 0;
                    vertical-align: middle;
                }

                .box-promotion .box-promotion-item a.box-promotion-close {
                    background-image: url({{ asset('images/css/close-button.png')  }});
                    background-repeat: no-repeat;
                    width: 48px;
                    height: 48px;
                    top: -51px;
                }

                .box-promotion .box-promotion-item a.box-promotion-close {
                    cursor: pointer;
                    position: absolute;
                    right: 0;
                    z-index: 999;
                    text-indent: -99999px
        
                }
                .modal-body .error{
                    color: red;
                }
                .client-login{
                    display: none;
                    position: absolute;
                    top: 87px;
                    background: red;
                    padding: 10px;
                    z-index: 999;
                }
                .logins-modal, .register-form{
                    cursor: pointer;
                }

                .logins-modal:hover{
                    color: red;
                }
                .register-form:hover{
                    color: red;
                }
              


            </style>
        </div>

       
        <?php  


            $userClient = session()->get('status-login');

            
            $popup = App\Models\popup::find(4);

            
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

        @if(\Request::route()->getName() =="homeFe")
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
                        <img src="{{ asset('images/template/logochuan.jpg') }}">   
                   
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
                        <input  type="text" class="input-search" placeholder="tìm sản phẩm..." name="key" autocomplete="off" maxlength="100">
                        <button type="submit">
                        <i class="icon-search"></i>
                        </button>
                        <div id="search-result"></div>
                    </form>


                    <?php
                        $cart = Gloudemans\Shoppingcart\Facades\Cart::content();


                        $number_cart = count($cart);

                        $active_cart =  count($cart)>0?'active':'';
                     ?>   
                    <a href="javascript:void(0)" class="header__cart {{ $active_cart }}" onclick="showToCart()" style="margin-right: -58px;">

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


                    <!-- <a href="tel: 02473036336" class="header__cart {{ $active_cart }}">
                        <i class="fa fa-user" aria-hidden="true" style="font-size:22px"></i>
                         <div class="div-text">
                            <a rel="nofollow" class="logins-modal" href="javascript:void(0)">
                                <span style="color:#fff; font-size: 12px;">Đăng nhập</span>
                            </a>
                        
                            <a rel="nofollow" class="register-form" href="javascript:void(0)">
                                <span style="color: #fff; font-size:12px;">Đăng ký</span>
                            </a>
                            
                        </div>
                    </a> -->
                    
                    @endif

                               
                    <a href="{{ route('tin') }}" class="header__history">Tin tức khuyến mãi</a>
                    <!-- <div class="bordercol"></div> -->

                </section>
            </div>

            

            <div class="header__top header__top-mobile mobiles">
                <section>
                    <div class="col-xs-12">
                        <a href="/" class="header__logo">
                            <img src="{{ asset('images/template/logochuan.jpg') }}">   
                       
                        </a>

                    </div>
                    
                    
                    <div class="col-xs-12">
                        <form  class="header__search" method="get" action="{{ route('search-product-frontend') }}">
                            <input id="skw" type="text" class="input-search" placeholder="tìm sản phẩm..." name="key" autocomplete="off" maxlength="100">
                            <button type="submit">
                            <i class="icon-search"></i>
                            </button>
                            <div id="search-result"></div>
                        </form>
                    </div>    

                    <?php
                        $cart = Gloudemans\Shoppingcart\Facades\Cart::content();


                        $number_cart = count($cart);

                        $active_cart =  count($cart)>0?'active':'';
                     ?>  
                    <div class="row col-12 all-icons-head">  
                        <div class="col-4 icons-heads icons-1">
                            
                            <a href="javascript:void(0)" class="header__cart {{ $active_cart }}" onclick="showToCart()" style="width: auto;">
                                <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:22px"></i>
                                <b id="count_shopping_cart_store"><span class="number-cart">{{ $number_cart }}</span></b>
                            </a>
                             
                        </div>

                        <div class="col-4 icons-heads icons-2">
                            

                           <a href="tel: 02473036336" class="header__cart ">
                                 <i class="fa fa-phone phones-customn" aria-hidden="true" style="font-size:22px"></i>
                            </a>
                        </div>

                        <div class="col-4 icons-heads icons-3">
                            
                            <a href="{{ route('tin') }}" class="header__cart ">
                                <i class="fa fa-newspaper-o" aria-hidden="true" style="font-size:22px"></i>
                                
                            </a>
                        </div>
                        
                    </div>
                    

                
                </section>
            </div>
            <div class="header__top desktop menu-pc">
                <div class="menu-section">
                    <ul class="list-menu">
                        <li class="child" data-id="tivi-child">

                            <a class="list-mn" href="{{ route('details', 'ti-vi') }}">
                                <i class="fa fa-television" aria-hidden="true"></i>
                                <span>Tivi</span>
                            </a>
                            <div class="navmwg accessories tivi-child">
                                <div class="PKDD">
                                    <strong>Thương hiệu</strong>
                                    <a href="#">
                                        <h3>Tivi Samsung</h3>
                                    </a>
                                    <a href="/sac-cap">
                                        <h3>Tivi LG</h3>
                                    </a>
                                    <a href="/mieng-dan-man-hinh">
                                        <h3>Tivi Sony</h3>
                                    </a>
                                    <a href="/op-lung-flipcover">
                                        <h3>Tivi Tcl</h3>
                                    </a>
                                    <a href="/op-lung-may-tinh-bang">
                                        <h3>Tivi Philips</h3>
                                    </a>
                                   
                                   
                                    <br><br>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Loại tivi</strong>
                                        <a href="/chuot-may-tinh">
                                            <h3>8K</h3>
                                        </a>
                                        <a href="/thiet-bi-mang">
                                            <h3>4K</h3>
                                        </a>
                                        <a href="/camera-giam-sat">
                                            <h3>Tivi màn hình cong</h3>
                                        </a>
                                        <a href="/tui-chong-soc">
                                            <h3>Tivi 3D</h3>
                                        </a>
                                        <a href="/phan-mem">
                                            <h3>Smart tivi</h3>
                                        </a>

                                          <a href="/tui-chong-soc">
                                            <h3>Tivi 3D</h3>
                                        </a>
                                      

                                          <a href="/tui-chong-soc">
                                            <h3>Tivi Led</h3>
                                        </a>
                                        <a href="/phan-mem">
                                            <h3>Smart tivi</h3>
                                        </a>
                                          <a href="/tui-chong-soc">
                                            <h3>Tivi OLED</h3>
                                        </a>
                                        
                                       
                                    </div>
                                    <div class="PKCH">
                                        <strong>
                                        Kích cỡ tivi
                                        
                                        </strong>
                                        <a href="/phu-kien/apple">
                                            <h3>tivi 32 inches</h3>
                                        </a>
                                        <a href="/phu-kien/samsung">
                                            <h3>tivi 49 inches</h3>
                                        </a>
                                        <a href="/phu-kien/sony">
                                            <h3>tivi 55 inches</h3>
                                        </a>
                                        <a href="/phu-kien/jbl">
                                            <h3>tivi từ 65 inches trở lên</h3>
                                        </a>
                                        <a href="/phu-kien/xiaomi">
                                            <h3>tivi 50 inches</h3>
                                        </a>
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </li>
                        <li class="child" data-id="tulanh-child">
                            <a class="list-mn" href="{{ route('details', 'tu-lanh') }}">
                                <i class="fa fa-television" aria-hidden="true"></i>
                                <span>Tủ lạnh</span>
                            </a>

                            <div class="navmwg accessories tulanh-child">
                                <div class="PKDD">
                                    <strong>Thương hiệu</strong>
                                    <a href="#">
                                        <h3>Hitachi</h3>
                                    </a>
                                    <a href="/sac-cap">
                                        <h3>Panasonic</h3>
                                    </a>
                                    <a href="/mieng-dan-man-hinh">
                                        <h3>Samsung</h3>
                                    </a>
                                    <a href="/op-lung-flipcover">
                                        <h3>Sharp</h3>
                                    </a>
                                    <a href="/op-lung-may-tinh-bang">
                                        <h3>LG</h3>
                                    </a>

                                    <a href="/op-lung-may-tinh-bang">
                                        <h3>Electrolux</h3>
                                    </a>

                                    <a href="/op-lung-may-tinh-bang">
                                        <h3>Funiki</h3>
                                    </a>
                                   
                                   
                                    <br><br>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Dung tích</strong>
                                        <a href="/chuot-may-tinh">
                                            <h3>Dưới 150 lít</h3>
                                        </a>
                                        <a href="/thiet-bi-mang">
                                            <h3>Từ 150 - 200 lít</h3>
                                        </a>
                                        <a href="/camera-giam-sat">
                                            <h3>Từ 200 - 300 lít</h3>
                                        </a>
                                        <a href="/tui-chong-soc">
                                            <h3>Từ 300 - 400 lít</h3>
                                        </a>
                                        <a href="/phan-mem">
                                            <h3>Từ 400 - 500 lít</h3>
                                        </a>

                                          <a href="/tui-chong-soc">
                                            <h3>Từ 500 - 600 lít</h3>
                                        </a>
                                      

                                          <a href="/tui-chong-soc">
                                            <h3>Trên 600 lít</h3>
                                        </a>
                                        
                                    
                                    </div>
                                    <div class="PKCH">
                                        <strong>
                                       Loại tủ
                                        
                                        </strong>
                                        <a href="/phu-kien/apple">
                                            <h3>Tủ lạnh Side By Side</h3>
                                        </a>
                                        <a href="/phu-kien/samsung">
                                            <h3>Tủ lạnh ngăn đá dưới</h3>
                                        </a>
                                        <a href="/phu-kien/sony">
                                            <h3>Tủ Lạnh Ngăn Đá Trên</h3>
                                        </a>
                                        <a href="/phu-kien/jbl">
                                            <h3>Tủ Lạnh Mini</h3>
                                        </a>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </li>


                        <li class="child" data-id="may-giat-child">
                            <a class="list-mn" href="/may-giat">
                                <i class="icon-maygiat"></i>
                                <span>Máy giặt</span>
                            </a>

                            <div class="navmwg accessories may-giat-child">
                                <div class="PKDD">
                                    <strong>Thương hiệu</strong>
                                    <a href="#">
                                        <h3>Máy giặt Electrolux</h3>
                                    </a>
                                    <a href="/sac-cap">
                                        <h3>Máy giặt LG</h3>
                                    </a>
                                    <a href="/mieng-dan-man-hinh">
                                        <h3>Máy giặt Panasonic</h3>
                                    </a>
                                    <a href="/op-lung-flipcover">
                                        <h3>Máy giặt Samsung</h3>
                                    </a>
                                    <a href="/op-lung-may-tinh-bang">
                                        <h3>Máy giặt Sharp</h3>
                                    </a>
                                   
                                   
                                    <br><br>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Kiểu giặt</strong>
                                        <a href="/chuot-may-tinh">
                                            <h3>Lồng Ngang</h3>
                                        </a>
                                        <a href="/thiet-bi-mang">
                                            <h3>Lồng Đứng</h3>
                                        </a>
                                        <a href="/camera-giam-sat">
                                            <h3>Lồng Nghiêng</h3>
                                        </a>
                                        
                                        
                                       
                                    </div>
                                    <div class="PKCH">
                                        <strong>
                                        Khối lượng giặt
                                        
                                        </strong>
                                        <a href="/phu-kien/apple">
                                            <h3>Dưới 7kg</h3>
                                        </a>
                                        <a href="/phu-kien/samsung">
                                            <h3>Từ 7 - 8kg</h3>
                                        </a>
                                        <a href="/phu-kien/sony">
                                            <h3>Từ 8 - 9kg</h3>
                                        </a>
                                        <a href="/phu-kien/jbl">
                                            <h3>Trên 9kg</h3>
                                        </a>
                                       
                                    </div>
                                   
                                    
                                </div>
                            </div>

                        </li>

                        <li class="child" data-id="dieu-hoa-child">
                            <a class="list-mn" href="/dieu-hoa">
                                <i class="icon-maylanh"></i>
                                <span>Điều hòa</span>
                            </a>
                            <div class="navmwg accessories dieu-hoa-child">
                                <div class="PKDD">
                                    <strong>Thương hiệu</strong>
                                    <a href="#">
                                        <h3>Máy giặt Electrolux</h3>
                                    </a>
                                    <a href="/sac-cap">
                                        <h3>Máy giặt LG</h3>
                                    </a>
                                    <a href="/mieng-dan-man-hinh">
                                        <h3>Máy giặt Panasonic</h3>
                                    </a>
                                    <a href="/op-lung-flipcover">
                                        <h3>Máy giặt Samsung</h3>
                                    </a>
                                    <a href="/op-lung-may-tinh-bang">
                                        <h3>Máy giặt Sharp</h3>
                                    </a>
                                   
                                   
                                    <br><br>
                                </div>
                                <div class="sub-cate">
                                    <div class="PKLT">
                                        <strong>Tiết Kiệm Điện</strong>
                                        <a href="/chuot-may-tinh">
                                            <h3>Lồng Ngang</h3>
                                        </a>
                                        <a href="/thiet-bi-mang">
                                            <h3>Lồng Đứng</h3>
                                        </a>
                                        <a href="/camera-giam-sat">
                                            <h3>Lồng Nghiêng</h3>
                                        </a>
                                        
                                        
                                       
                                    </div>
                                    <div class="PKCH">
                                        <strong>
                                        Công Suất
                                        
                                        </strong>
                                        <a href="/phu-kien/apple">
                                            <h3>Dưới 7kg</h3>
                                        </a>
                                        <a href="/phu-kien/samsung">
                                            <h3>Từ 7 - 8kg</h3>
                                        </a>
                                        <a href="/phu-kien/sony">
                                            <h3>Từ 8 - 9kg</h3>
                                        </a>
                                        <a href="/phu-kien/jbl">
                                            <h3>Trên 9kg</h3>
                                        </a>
                                       
                                    </div>

                                     <div class="PKCH">
                                        <strong>
                                       Loại Điều Hòa
                                        
                                        </strong>
                                        <a href="/phu-kien/apple">
                                            <h3>Dưới 7kg</h3>
                                        </a>
                                        <a href="/phu-kien/samsung">
                                            <h3>Từ 7 - 8kg</h3>
                                        </a>
                                        <a href="/phu-kien/sony">
                                            <h3>Từ 8 - 9kg</h3>
                                        </a>
                                        <a href="/phu-kien/jbl">
                                            <h3>Trên 9kg</h3>
                                        </a>
                                       
                                    </div>

                                    
                                   
                                    
                                </div>
                            </div>
                        </li>

                        <li class="child" data-id="dieu-hoa-child">
                            <a class="list-mn" href="#">
                                <i class="icon-diengiadung"></i>
                                <span>Đồ gia dụng</span>
                            </a>
                        </li>

                        <li class="child" data-id="dieu-hoa-child">
                            <a class="list-mn" href="#">
                                <i class="icon-diengiadung"></i>
                                <span>Tủ đông</span>
                            </a>
                        </li>

                        <li class="child" data-id="dieu-hoa-child">
                            <a class="list-mn" href="#">
                                <i class="icon-diengiadung"></i>
                                <span>A.O.Smith</span>
                            </a>
                        </li>

                         <li class="child" data-id="dieu-hoa-child">
                            <a class="list-mn" href="#">
                                <i class="icon-diengiadung"></i>
                                <span>Tủ Mát</span>
                            </a>
                        </li>

                    </ul>
                </div>
                

            </div>

            
            <div class="header__main">
                <section>

                    <div class="category mobile">
                        <p class="category__txts">
                        <span class="menu-list">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span></p>
                        <!-- <a href="/danh-muc-nhom-hang" class="category__all">Tất cả nhóm hàng</a> -->
                        <nav class="nav-list">
                            <a href="/dtdd">Tivi</a>
                            <a href="/laptop-ldp">Tủ lạnh</a>
                            <a href="/may-tinh-bang">Máy giặt</a>
                            <a href="/phu-kien">Điều hòa</a>
                            <a href="/dong-ho-thong-minh-ldp">Đồ gia dụng</a>
                            <a href="/avaji">Tủ đông</a>
                            <a href="/pc-may-in">Tủ mát</a>
                            <a href="/may-doi-tra">Máy sấy quần áo</a>
                            <a href="/sim-so-dep">A.O.Smith</a>
                            <a href="/tien-ich" class="promotion-menu">
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông tin giỏ hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="tbl_list_carts">
                            
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
                                <div class="item-form" style="width: 50%;display: inline-block;">
                                    <input type="text" name="name" id="buyer_name" placeholder="Họ tên">
                                </div>
                                <div class="item-form" style="width: 49%;display: inline-block;">
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
                                                <td><input type="radio" style="width:initial; padding:0; margin:0; height:auto;" checked="" name="pay_method" value="1" class="pay_option" id="paymethod_1"></td>
                                                <td>
                                                    <label for="paymethod_1">Thẻ tín dụng</label>
                                                    <div id="pay_0" style="display:none;" class="pay_content"></div>
                                                </td>
                                            </tr>
                                            <tr class="item-paymethod">
                                                <td><input type="radio" style="width:initial; padding:0; margin:0; height:auto;" name="pay_method" value="2" class="pay_option" id="paymethod_2"></td>
                                                <td>
                                                    <label for="paymethod_2">Thẻ ATM nội địa</label>
                                                    <div id="pay_1" style="display:none;" class="pay_content"></div>
                                                </td>
                                            </tr>
                                            <tr class="item-paymethod">
                                                <td><input type="radio" style="width:initial; padding:0; margin:0; height:auto;" name="pay_method" value="3" class="pay_option" id="paymethod_3"></td>
                                                <td>
                                                    <label for="paymethod_3">Trả tiền khi nhận hàng</label>
                                                    <div id="pay_2" style="display:none;" class="pay_content">Trả tiền khi nhận hàng</div>
                                                </td>
                                            </tr>
                                            <tr class="item-paymethod">
                                                <td><input type="radio" style="width:initial; padding:0; margin:0; height:auto;" name="pay_method" value="4" class="pay_option" id="paymethod_4"></td>
                                                <td>
                                                    <label for="paymethod_4">Thanh toán trả góp qua Alepay (Qua thẻ Visa, Master, JCB)</label>
                                                    <div id="pay_3" style="display:none;" class="pay_content"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="clear"></div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
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

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-footer">
                        <h3 class="title">Thông tin</h3>
                        <ul class="footer_list-link">
                            <li>
                                <a href="#">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="#">Liên hệ</a>
                            </li>
                            <li>
                                <a href="#">Dự án bán buôn</a>
                            </li>

                          
                            <li class="mobile">
                                <a href="{{ Route::getFacadeRoot()->current()->uri() }}?show=pc_view">Xem bản desktop</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-footer">
                        <h3 class="title">Hỗ trợ mua hàng</h3>
                        <ul class="footer_list-link">
                            <li>
                                <a href="#">Hướng dẫn trả góp</a>
                            </li>
                            <li>
                                <a href="#">Cách thức thanh toán</a>
                            </li>
                            <li>
                                <a href="#">Bảng giá vật tư lắp đặt</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-footer">
                        <h3 class="title">Tổng đài hỗ trợ</h3>
                        <ul class="footer_list-link">
                            <li>Mua hàng
                                <a href="tel:02473036336">0247.303.6336</a>
                            </li>
                            <li>CSKH
                                <a href="tel:0916917949">0916917949</a>
                            </li>
                            <li>Bảo hành
                                <a href="tel:02436879145">0243.687.9145</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-footer">
                        <h3 class="title">Chính sách</h3>
                        <ul class="footer_list-link">
                            <li>
                                <a href="#">Chính sách &amp; quy định chung</a>
                            </li>
                            <li>
                                <a href="#">Chính sách đổi trả sản phẩm</a>
                            </li>
                            <li>
                                <a href="#">Chính sách bảo hành</a>
                            </li>
                            <li>
                                <a href="#">Chính sách giao hàng</a>
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
                        <a rel="nofollow" href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=1180"><img style="max-height: 40px" src="/images/template/dathongbao.png"></a>
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
        

        
         <script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>
         <script src="{{ asset('js/layout1.js') }}" type="text/javascript"></script>
        
        <!-- <script async="async" defer="defer" src="https://cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/homeGTM.min.v202111271240.js" type="text/javascript"></script> -->
        <script>
            window.dataLayer = window.dataLayer || [];
            
            dataLayer.push({ 'pageType':'Home','pagePlatform':'Web','pageStatus':'Kinh doanh'})
            
            
            
        </script>

        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        
  

    <link rel="stylesheet" href="{{asset('css/lib/owl.carousel.min.css')}}">


    <link rel="stylesheet" href="{{asset('css/lib/owl.theme.default.min.css')}}">
    <script type="text/javascript" src="{{asset('js/lib/owl.carousel.min.js')}}"></script>

  
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>

    <script src="{{asset('js/lib/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/lib/lazyload.js') }}"></script>
    <script src="{{ asset('js/lib/sweetalert2.all.min.js') }}"></script>


    @stack('script')

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
            $('#tbl_list_carts').html('');
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

                    $('#tbl_list_carts').append(result);

                   
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
            else{
                if(numberProduct<=0){
                    alert('không thể mua sản phẩm vì trong giỏ hàng ko có sản phẩm')
                    event.preventDefault();
                }
                else{
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