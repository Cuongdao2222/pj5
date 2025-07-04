

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

        <meta name="robots" content="{{ (isset($actives_pages_blog) && $actives_pages_blog ==0)?'noindex':'index' }},follow" />
        @if(!empty($meta))
        <title>{{ $meta->meta_title }}</title>
        <meta name="description" content="{{ $meta->meta_content }}"/>
        <meta property="og:title" content="{{ $meta->meta_title }}" />
        @if(!empty($data) && !empty($data->Image))
        <meta property="og:image" content="{{ asset($data->Image) }}"/>
        @endif
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
        <link rel="canonical" href="{{ url()->current() }}" >
        <meta name = "google-site-verify" content = "1AH1fN3G7ygWRcOlEQWJyhginaxmT67zTMPP8wnfFD0" />
        <meta name="google-site-verification" content="P-EnxCkmnXXEDeC0FWq-rSxjbSSyy9HeimO6f2Evtyc" />
        <meta property="zalo-platform-site-verification" content="UTYP5VFbJZ8Yz-G8uFTfDZxws27IX0fyDZK" />
      
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
        <meta property="og:image" content="{{ asset('images/template/logo.png') }}?ver=1" />
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
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/apps.css') }}?ver=23">
        <link rel="stylesheet" type="text/css" href="{{asset('css/dienmay.css')}}?ver=119">
        <link rel="stylesheet" type="text/css" href="{{asset('css/detailsfe.css')}}?ver=7"> 
        <meta name="csrf-token" content="{{ csrf_token() }}">

    
        <style type="text/css">
            /*body.theme-lunar-new-year{
                overflow-x: hidden;
            }*/
            .commit{
                margin-bottom: 10px;
                color: #000;
            }

            .commit span{
                font-size: 14px;
            }


            .category__all{
                padding-left: 15px !important;
                width: 100% !important;
            }
            .category{
                box-shadow: none !important;
            }

/*            popup*/

            #box-promotion .box-banner{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 540px;
                height: 540px;
                
            }

            .box-promotion-item{
               
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.7);
                z-index: 9999;
                width: 100%;
                height: 100%;
            }

            .box-promotion-close{
                position: absolute;
                top:0;

                color: red;
                font-size: 25px;
            }

            .main-menu{
                width: 240px;
            }

            .bar-top-left {
                position: absolute !important;
                background-color: #fff;
            }
            
            .listcompare-click{
                display: none;
            }

            .category__all{
                color: #000 !important;
               
            }

            .event-dt, .event{
                display:none;
            } 

            .event{
                width: 70px;
                height: 70px;
                
                position: absolute;
                top: 0;
                left: 10px;
                z-index: 999;
            
            }

            .list-menu .category{
                width: 243px;
                border: 1px solid #ddd;
            }

            .compare-pro-holder a {
                display: block;
                width: 100%;
                margin-right: 35px;
                /*float: left;*/
            }

            .sub-cate h3, .compare-show, .gift-text span{
                font-size: 14px;
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

            .header__top {
                background-color: #42b6ed !important;
            }

            #ui-id-2{
                background: #fff;
                z-index: 99999;
            }


            #ui-id-1{
                z-index: 99999;
                background: #fff;
                width: 29vmax !important;
            }

            .listproduct .item-img, .listproduct .item .item-img img{
                margin-top: 0;
            }
            .bar-top-lefts img, .bar-top-left img{
                width:27px;
            }

    .ft-dmca img{
            width: 100%;
        }
       /* .nk-menu .span16{
            padding: 0;
        }*/

        .ring-phone {
            float: left;
            position: fixed;
            right: 50%;
            bottom: 10px;
            z-index: 99999;
        }

        .coccoc-alo-phone {
            background-color: transparent;
            width: 100px;
            height: 100px;
            cursor: pointer;
            z-index: 200000 !important;
            -webkit-backface-visibility: hidden;
            -webkit-transform: translateZ(0);
            -webkit-transition: visibility .5s;
            -moz-transition: visibility .5s;
            -o-transition: visibility .5s;
            transition: visibility .5s;
            position: relative;
            z-index: 10;
        }

        .coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle {
            background: linear-gradient(90deg, #d1a94e, #fdf5a1, #cfac54);
            opacity: .5;
        }

        .coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle-fill {
            background: linear-gradient(90deg, #d1a94e, #fdf5a1, #cfac54);
            opacity: .75 !important;
        }

        .coccoc-alo-ph-img-circle {
            width: 50px;
            height: 50px;
            top: 25px;
            left: 25px;
            position: absolute;
            background: rgba(30, 30, 30, 0.1) url({{ asset('images/template//phone-fix.png') }} no-repeat center center;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            border: 2px solid transparent;
            opacity: 1;
            -webkit-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            -moz-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            -ms-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            -o-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            background-size: cover;
        }

        .coccoc-alo-ph-circle {
            width: 100px;
            height: 100px;
            top: 0;
            left: 0;
            position: absolute;
            background-color: transparent;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            border: 2px solid rgba(30, 30, 30, 0.4);
            opacity: .1;
            -webkit-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
            -moz-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
            -ms-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
            -o-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
            animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
            z-index: 10;
        }

        .ring-phone:hover .list-phone {
            width: 160px;
            transition: .5s;
            opacity: 1;
        }

        .list-phone {
            position: absolute;
            left: 50%;
            top: 50%;
            float: left;
            transform: translateY(-50%);
            z-index: 1;
            width: 1px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            transition: .5s;
            overflow: hidden;
            opacity: 0;
        }

        .list-phone a {
            width: 124px;
            float: right;
            line-height: 30px;
            margin: 3px 0;
            border-radius: 15px;
            padding: 0 10px;
            text-decoration: none;
            color: #000;
            font-size: 16px;
            font-weight: 700;
            background: linear-gradient(0deg, #d1a94e, #fdf5a1, #cfac54);
        }

        .coccoc-alo-ph-circle-fill {
            width: 70px;
            height: 70px;
            top: 15px;
            left: 15px;
            position: absolute;
            background-color: #000;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            border: 2px solid transparent;
            opacity: .1;
            -webkit-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
            -moz-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
            -ms-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
            -o-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
            animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .coccoc-alo-ph-img-circle {
            width: 50px;
            height: 50px;
            top: 25px;
            left: 25px;
            position: absolute;
            background: rgba(30, 30, 30, 0.1) url({{ asset('images/template/phone-fix.png')  }}) no-repeat center center;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            border: 2px solid transparent;
            opacity: 1;
            -webkit-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            -moz-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            -ms-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            -o-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
            background-size: cover;
        } 

        @keyframes coccoc-alo-circle-anim {
            0% {
                transform: rotate(0) scale(.5) skew(1deg);
                opacity: .1;
            }
            30% {
                transform: rotate(0) scale(.7) skew(1deg);
                opacity: .5;
            }

            100% {
                transform: rotate(0) scale(1) skew(1deg);
                opacity: .1;
            }
        }    

        @keyframes coccoc-alo-circle-fill-anim {

            0% {
                transform: rotate(0) scale(.7) skew(1deg);
                opacity: .2;
            }
            50% {
                transform: rotate(0) scale(1) skew(1deg);
                opacity: .2;
            }
            100% {
                transform: rotate(0) scale(.7) skew(1deg);
                opacity: .2;
            }
        }    

        @keyframes coccoc-alo-circle-img-anim {
            0% {
                transform: rotate(0) scale(1) skew(1deg);
            }
            10% {
                transform: rotate(-25deg) scale(1) skew(1deg);
            }
            20% {
                transform: rotate(25deg) scale(1) skew(1deg);
            }
            30% {
                transform: rotate(-25deg) scale(1) skew(1deg);
            }
            40% {
                transform: rotate(25deg) scale(1) skew(1deg);
            }
            50% {
                transform: rotate(0) scale(1) skew(1deg);
            }
            100% {
                transform: rotate(0) scale(1) skew(1deg);
            }
        }           

        @media only screen and (min-width: 601px) {
            /*.div-foot{
                margin-left: 330px;
            }*/


            .banner-ads-text .header-menu__navs{
                height: 40px;
            }

            .footer-new * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
        } 

         @media only screen and (max-width: 600px) {

             .ring-phone {

                left: 0 !important;
            }

            .header__top-mobile{
                background: #000;
            }

        }    




            
        </style>

        <!-- tắt hiệu ứng tuyết rơi -->

        <!-- <style>
            #snowflakeContainer{position:absolute;left:0px;top:0px;}
            .snowflake{padding-left:15px;font-size:14px;line-height:24px;position:fixed;color:#ebebeb;user-select:none;z-index:1000;-moz-user-select:none;-ms-user-select:none;-khtml-user-select:none;-webkit-user-select:none;-webkit-touch-callout:none;}
            .snowflake:hover {cursor:default}
        </style>
        <div id='snowflakeContainer'>
        <p class='snowflake'>❄</p>
        </div>
        <script style='text/javascript'>
            //<![CDATA[
            var requestAnimationFrame=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame;var transforms=["transform","msTransform","webkitTransform","mozTransform","oTransform"];var transformProperty=getSupportedPropertyName(transforms);var snowflakes=[];var browserWidth;var browserHeight;var numberOfSnowflakes=30;var resetPosition=false;function setup(){window.addEventListener("DOMContentLoaded",generateSnowflakes,false);window.addEventListener("resize",setResetFlag,false)}setup();function getSupportedPropertyName(b){for(var a=0;a<b.length;a++){if(typeof document.body.style[b[a]]!="undefined"){return b[a]}}return null}function Snowflake(b,a,d,e,c){this.element=b;this.radius=a;this.speed=d;this.xPos=e;this.yPos=c;this.counter=0;this.sign=Math.random()<0.5?1:-1;this.element.style.opacity=0.5+Math.random();this.element.style.fontSize=4+Math.random()*30+"px"}Snowflake.prototype.update=function(){this.counter+=this.speed/5000;this.xPos+=this.sign*this.speed*Math.cos(this.counter)/40;this.yPos+=Math.sin(this.counter)/40+this.speed/30;setTranslate3DTransform(this.element,Math.round(this.xPos),Math.round(this.yPos));if(this.yPos>browserHeight){this.yPos=-50}};function setTranslate3DTransform(a,c,b){var d="translate3d("+c+"px, "+b+"px, 0)";a.style[transformProperty]=d}function generateSnowflakes(){var b=document.querySelector(".snowflake");var h=b.parentNode;browserWidth=document.documentElement.clientWidth;browserHeight=document.documentElement.clientHeight;for(var d=0;d<numberOfSnowflakes;d++){var j=b.cloneNode(true);h.appendChild(j);var e=getPosition(50,browserWidth);var a=getPosition(50,browserHeight);var c=5+Math.random()*40;var g=4+Math.random()*10;var f=new Snowflake(j,g,c,e,a);snowflakes.push(f)}h.removeChild(b);moveSnowflakes()}function moveSnowflakes(){for(var b=0;b<snowflakes.length;b++){var a=snowflakes[b];a.update()}if(resetPosition){browserWidth=document.documentElement.clientWidth;browserHeight=document.documentElement.clientHeight;for(var b=0;b<snowflakes.length;b++){var a=snowflakes[b];a.xPos=getPosition(50,browserWidth);a.yPos=getPosition(50,browserHeight)}resetPosition=false}requestAnimationFrame(moveSnowflakes)}function getPosition(b,a){return Math.round(-1*b+Math.random()*(a+2*b))}function setResetFlag(a){resetPosition=true};
            //]]>
        </script> -->
 
        <!-- end hiệu ứng -->

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
            .danh-muc1, .danh-muc2{
                left: 0px !important;
            } 

           

            .hotlines{
                position:fixed; 
                z-index:9999
            }   

            #ui-id-1{
                font-size: 14px;
            }

            .submenu strong{
                font-size: 14px;
            } 

            .submenu h3{
                font-size: 14px;
            } 

             @media only screen and (min-width: 768px) {
                .hotlines{
                   
                    bottom:93px; 
                    right:8px; 
                    display: block;   
                }

                .box-common__tab li {

                    width: 13%;
                }    
                .item-rating{
                    display: none !important;
                }

                .phones-hotline{
                    width: auto !important;
                    padding: 7px 0;
                }

                .phones-hotline a{
                    font-size: 13px;
                }

                .line-mobile{
                    display: none;
                }

                .theme-xmas.header:after {
                content: '';
                background-size: 90%;
                width: 12%;
                height: 18%;
                position: absolute;
                z-index: 2;
                background-image:  url('{{ asset("images/template/header-rope-right-23.png")  }}');
                top: 0;
                right: 0;
                background-repeat: no-repeat;
                display: none;
            }

            .theme-xmas.header:before {
                content: '';
                background-size: 90%;
                width: 12%;
                height: 18%;
                position: absolute;
                z-index: 2;
                background-image: url('{{ asset("images/template/header-rope-left-23.png")  }}');
                left: 0;
                top: 0;
                background-repeat: no-repeat;
                display: none;
            }   
            .header-pc{
                height: 80px;
            } 


                .zalo-chat-widget{  
                    bottom: 6% !important;  
                    right: 1%!important;  
                }  

                .hotline{
                    width: 237px;
                }

                .hotline p{

                    margin-bottom: 1em;
                }
                .global-compare-group{
                    height: 300px;
                }
                .list-menu{
                    margin-bottom: 0;
                }

                .submenu {

                    left:240px !important;

               }

               .hotline{
                    position: absolute;
                    
               }

                a.hotline-fix {
                    background: #FCEF41;
                    border-radius: 7px 0px 0px 0px;
                    margin-bottom: 5px;
                    font-size: 15px;
                }

                .hotline.position-fixed {
                    bottom: 21%;
                    right: 0;
                    padding: 0.5rem 0.3rem 0.5rem 0.8rem;
                    border-radius: 13px 0px 0px 13px;
                    background-color: transparent;
                    z-index: 99;
                    transition: 0.3s;
                }

                .hotline.position-fixed a i {
                    width: 35px;
                    height: 35px;
                    border: 1px solid #002069;
                    border-radius: 50%;
                    text-align: center;
                    line-height: 35px;
                    margin-right: 10px;
                    color: #002069;
                }

                .text-white {
                    color: #fff!important;
                }

               /* .zalo-mobile{
                    display: none;
                }*/

              /*  .zalo-icon{
                    left: 73%;
                }*/
            }

            @media only screen and (max-width: 768px) {
                  .menus-banner .strongtitle {
                    font-size: 12px !important;
                    -webkit-line-clamp: 1;
                      -webkit-box-orient: vertical;
                      overflow: hidden;
                      display: -webkit-box;
                  } 

               /* .list-phone{
                    display: none;
                }   */

                 .commit{
                    font-size: 15px;
                }  

                .show-mobile{
                    bottom: 35px !important;
                }  

                .ui-widget-content p{

                    font-size: 15px;
                }

                .zalo-chat-widget{  
                    bottom: 0;  
/*                    left: 10px!important;  */
                }  




                .suggest_link{
                    font-size: 14px;
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

        <style type="text/css">
            

            .border-rd{
                border-radius: 4px;
                border: 1px solid #fff;
                padding: 9px;
            }

            .pine-tree img {
                width: 10%;
                position: fixed;
            }

            .pine-tree-right {
                left: 90vw;
/*                transform: rotate(335deg);*/
            }

            .pine-tree-left, .pine-tree-right {
                bottom: 0;
                cursor: pointer;
                z-index: 1;
/*                animation: lighting 1s infinite;*/
            }

            .pine-tree-left, .pine-tree-right {
                bottom: 0px;
                cursor: pointer;
                z-index: 1;
/*                animation: 1s ease 0s infinite normal none running lighting;*/
            }

            @keyframes lighting {
              0% {
                content: url({{ asset('public/background/Asset3@3x.png')  }}));
              }
              to {
                content: url({{ asset('public/background/Asset5@3x.png')  }});
              }
            }

            .pine-tree .tuyet-left {
                bottom: 0;
                left: 1vw;
                cursor: pointer;
                z-index: 999;
                width: 9vw;
            }

            .pine-tree img {
                width: 10%;
                position: fixed;
            }

            .pine-tree .santa-left {
                bottom: 0;
                left: 0;
                cursor: pointer;
                z-index: 2;
                width: 3vw;
            }

            .pine-tree .santa-right {
                bottom: 0;
                right: 0;
                cursor: pointer;
                z-index: 2;
/*                width: 3vw;*/
            }

            @if(!empty(Auth::user()->id) && Auth::user()->id==1)

                .phpdebugbar{
                    display:block;
                }
            @else 
            
               .phpdebugbar{
                    display:none;
                }
            @endif

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
            <div class="box-promotion-item" style="width: 100%;height: 100%;">
                <div class="box-banner">
                   <img src="{{ asset( $popup->image) }}" alt="pop-up">
                    <a class="box-promotion-close" href="javascript:void(0)" title="Đóng lại">x</a>
                </div>
                
            </div>
        </div>
        @else

        @if(!empty($requestcheck)&& \Request::route()->getName() =="homeFe")
        <div id="box-promotion" class="box-promotion box-promotion-active">
            <div class="box-promotion-item" style="width: 100%;height: 100%;">
                <div class="box-banner">
                    <a href="{{ $popup->link }}" target="_blank" rel="nofollow"><img src="{{ asset( $popup->image) }}" alt="pop-up"></a>
                    <a class="box-promotion-close" href="javascript:void(0)" title="Đóng lại">[x]</a>
                </div>
                
            </div>
        </div>

        @endif

        @endif
        
        @endif

        <header class="header   theme-xmas" data-sub="0">

            <div class="header__top desktop header-pc">
                <section>
                    <a href="{{route('homeFe')}}" class="header__logo">
                        <img src="{{ asset('images/template/logo.png') }}?ver=1">   
                   
                    </a>
                   
                    <a href="tel: 02473036336" class="header__cart fas-phones">
                         <i class="fa fa-phone phones-customn" aria-hidden="true"></i>
                         <div class="div-text">
                            <span class="tel-head">0247.303.6336</span>
                            <span class="tvbhclient">Tư vấn bán hàng</span>

                            
                        </div>
                    </a>

                    <a href="https://goo.gl/maps/TozxKHRZeHfrafMt9" class="header__cart fas-phones" target="_blank">
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
                    <a href="{{ route('show-cart') }}" class="header__cart " style="margin-right: -58px;">

                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:22px"></i>
                        <b id="count_shopping_cart_store"><span class="number-cart">{{ $number_cart }}</span></b>
                    </a>

                    

                    <div class="fas-phones phones-hotline">          
                        <a href="tel: 0913011888" class="header__history tin-km">Hotline:0913.011.888</a>
                       
                    </div>

                

                   
                    <div class="fas-phones">          
                        <a href="{{ route('tins') }}" class="header__history tin-km">Tin tức, khuyến mãi </a>
                        <!-- <div class="bordercol"></div> -->
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
                                            
                                            <a href="/deal"><b>GIẢM GIÁ - DEAL HOT</b></a>
                                          
                                        </div>
                                    </li>    

                                    <li data-submenu-id="submenu-1">
                                        <div class="dropdown">
                                          
                                            <img src="{{ asset('media/category/cat_4d485476e07e02638e8e2133cdf8f56d.png') }}" class="iconss-sp">
                                            <a href="{{route('details','ti-vi')}}">Tivi</a>
                                        </div>
                                        <div id="submenu-1" class="submenu" style="display: none;">
                                            <aside>
                                                <a href="{{ route('details', 'thuong-hieu-tivi') }}"><strong>Thương hiệu</strong></a>
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
                                                <a href="{{route('details','tivi-sharp')}}">
                                                    <h3>Tivi Sharp</h3>
                                                </a>

                                                <a href="{{route('details','tivi-hisense')}}">
                                                    <h3>Tivi Hisense</h3>
                                                </a>
                                            </aside>
                                            <aside>
                                                <a href="{{ route('details', 'loai-tivi') }}"><strong>Loại tivi</strong></a>
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
                                                <a href="{{route('details','kich-co-tivi')}}"><strong>Kích cỡ tivi</strong></a>
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
                                                
                                                <a href="{{route('details','thuong-hieu-tu-lanh')}}"><strong>Thương hiệu</strong></a>
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

                                                <a href="{{route('details','tu-lanh-hisense')}}">
                                                    <h3>Tủ lạnh Hisense</h3>
                                                </a>
                                                
                                            </aside>
                                            <aside>

                                                <a href="{{route('details','dung-tich-tu-lanh')}}"><strong>Dung tích</strong></a>  
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
                                                <a href="{{route('details','loai-tu-lanh')}}"><strong>Loại tủ</strong></a>
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
                                                <a href="{{route('details','kieu-giat')}}"><strong>Kiểu giặt</strong></a>
                                                <hr>
                                                <a href="{{route('details','may-giat-long-ngang')}}">
                                                    <h3>Máy giặt lồng ngang</h3>
                                                </a>
                                                <a href="{{route('details','may-giat-long-dung')}}">
                                                    <h3>Máy giặt lồng đứng</h3>
                                                </a>
                                            </aside>
                                            <aside>
                                                <a href="{{ route('details', 'thuong-hieu-may-giat') }}"><strong>Thương hiệu</strong></a>
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

                                                <a href="{{route('details','may-giat-hisense')}}">
                                                    <h3>Máy giặt Hisense</h3>
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
                                                <a href="{{ route('details', 'thuong-hieu-dieu-hoa') }}"><strong>Thương hiệu</strong></a>  
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
                                                <!-- <a href="{{route('details','dieu-hoa-funiki')}}">
                                                    <h3>Điều hòa Funiki</h3>
                                                </a> -->
                                                <a href="{{route('details','dieu-hoa-samsung')}}">
                                                    <h3>Điều hòa Samsung</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-nagakawa')}}">
                                                    <h3>Điều hòa Nagakawa</h3>
                                                </a>
                                                <a href="{{route('details','dieu-hoa-midea')}}">
                                                    <h3>Điều hòa Midea</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'tiet-kiem-dien') }}"><strong>Tiết kiệm điện</strong></a>  
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
                                                <a href="{{ route('details', 'may-say-quan-ao-panasonic') }}"><strong>Máy sấy quần áo panasonic</strong></a>
                                                
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'may-say-quan-ao-lg') }}"><strong>Máy sấy quần áo LG</strong></a>
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'may-say-quan-ao-electrolux') }}"><strong>Máy sấy quần áo Electrolux</strong></a>
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'may-say-quan-ao-samsung') }}"><strong>Máy sấy quần áo Samsung</strong></a>
                                            </aside>
                                        </div>
                                    </li>

                                    <li data-submenu-id="submenu-6" class="">
                                        <div class="dropdown">
                                            <span>
                                                <img src="{{ asset('media/category/cat_d8bc7e22dcd3dcc525a4f3e9c7b433bc.png') }}" class="iconss-sp">
                                            </span>
                                            <a href="{{ route('details', 'may-loc-nuoc-aosmith') }}" class=""> A.O.Smith</a>
                                        </div>

                                        <div id="submenu-6" class="submenu" style="display: none;">
                                            <aside>
                                                <a href="{{ route('details', 'may-loc-nuoc-aosmith') }}"><strong>Máy Lọc Nước AoSmith</strong></a>
                                                
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'may-loc-nuoc-dau-nguon-aosmith') }}"><strong>Máy Lọc Nước Đầu Nguồn AoSmith</strong></a>
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'may-loc-khong-khi-ao-smith') }}"><strong>Máy Lọc Không Khí AOSmith</strong></a>
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


                                                <a href="{{route('details','quat')}}">
                                                    <h3>Quạt</h3>
                                                </a>
                                            </aside>

                                            <aside>
                                                <a href="{{ route('details', 'san-pham-nha-bep') }}"><strong>Sản phẩm nhà bếp</strong></a>
                                                
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
                                                <a href="{{route('details','noi-chien-khong-dau')}}">
                                                    <h3>Nồi chiên không dầu</h3>
                                                </a>

                                                <a href="{{route('details','lo-nuong')}}">
                                                    <h3>Lò nướng</h3>
                                                </a>

                                                <a href="{{route('details','bep-tu')}}">
                                                    <h3>Bếp từ</h3>
                                                </a>

                                                <a href="{{route('details','may-rua-bat')}}">
                                                    <h3>Máy rửa bát</h3>
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
                                                <a href=""><strong>Thương hiệu</strong></a>
                                               
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

                                    <!-- <li data-submenu-id="submenu-10" class="">
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

                                    </li> -->

                                </ul>

                                
                            </div>
                        </li>

                        @if(Cache::has('groups'))


                            <?php 

                                $menu =  Cache::get('groups');
                            ?>
                        @endif  

                        
                       
                        
                    </ul>
                </div>
                

            </div>

            

            <div class="header__top header__top-mobile mobiles">
                <section>
                    <div class="col-xs-12" style="display: flex; height: 63px;">
                        <div class="col-6">
                            <a href="/" class="header__logo">
                                <img src="{{ asset('images/template/logo.png') }}?ver=1">   
                           
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
                            <a href="{{ route('details','gia-dung') }}">Gia Dụng</a>
                            <a href="{{ route('details','lo-nuong') }}">Lò Nướng</a>
                            <!-- <a href="{{ route('details','may-loc-nuoc') }}">Máy lọc nước</a> -->
                            <a href="{{ route('details','may-say-quan-ao') }}">Máy sấy quần áo</a>
                            <a href="{{ route('details','may-loc-nuoc-aosmith') }}">A.O.Smith</a>
                            <a href="{{ route('details','quat') }}">Quạt</a>
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

                        <div class="c3_col_1 form-info-cart {{ $number_cart<=0?'hide':'' }}" >
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
                        
                        <style type="text/css">
                            .cart-container {
                                    text-align: center;
                                    padding: 20px;
/*                                    border: 1px solid #ccc;*/
                                    border-radius: 8px;
                                    background-color: #fff;
                                }

                                .empty-cart-message {
                                    font-size: 18px;
                                    color: #555;
                                    margin-top: 30px;
                                }

                                .cart-icon {
                                    font-size: 40px;
                                    color: #ccc;
                                }

                                #exampleModal .modal-body{
                                    min-height: 200px;
                                }
                        </style>

                        <div class="cart-container {{ $number_cart>0?'hide':'' }}">
                            <div class="cart-icon">🛒</div>
                            <div class="empty-cart-message">
                                <p>Không có sản phẩm nào trong giỏ hàng</p>
                                
                            </div>
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
                                <label class="col-md-4 col-form-label" for="number-phone">Số điện thoại </label>
                                <div class="col-md-8"><input class="form-control" data-val="true" data-val-required="Số điện thoại là bắt buộc" id="number-phone-customer" name="number-phone-register"> <span class="text-danger field-validation-valid" data-valmsg-for="FullName" data-valmsg-replace="true"></span></div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="Password">Mật khẩu</label>
                                <div class="col-md-8"><input class="form-control" type="password"></span></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="ConfirmPassword">Xác nhận mật khẩu</label>
                                <div class="col-md-8"><input class="form-control" type="password"  id="ConfirmPassword" name="ConfirmPassword" autocomplete="on"> <span class="text-danger field-validation-valid"></span></div>
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

        

        <!-- <div class="mobiles hotlines line-mobile">   
            <a href="tel:02473036336"><img src="{{ asset('images/template/tongdai02473036336.png') }}" alt="hotline" style="height:55px; z-index: 999;"></a>
              
            <div class="clear"></div>
              
        </div> -->

       <!--  <div class="hotlines show-mobile">   
            <a href="tel:0913011888"><img src="{{ asset('images/template/tongdai0247.png') }}" alt="hotline" style="height:55px; z-index: 999;"></a>
              
            <div class="clear"></div>
              
        </div> -->

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


       <!--  <button onclick="topFunction()" id="myBtn-top" title="Go to top"><i class="fas fa-angle-up"></i></button> -->
        
        <script>
            window.dataLayer = window.dataLayer || [];
            
            dataLayer.push({ 'pageType':'Home','pagePlatform':'Web','pageStatus':'Kinh doanh'})
            
            
            
        </script>

       <div class="ring-phone">
            <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
                <div class="coccoc-alo-ph-circle"></div>
                <div class="coccoc-alo-ph-circle-fill"></div>
                <div class="coccoc-alo-ph-img-circle"></div>
                <div class="list-phone"><a href="tel:02473036336">024.7303.6336</a> <a href="tel:0913011888">0913.011.888</a> </div>
            </div>
        </div>
     

        <div class="zalo-mobile">

            <a href="https://zalo.me/0913011888" target="_blank">
                <div style="position: fixed; bottom: 52px; right: 52px; transform: translate(0px, 0px) !important; z-index: 2147483644; border: none; visibility: visible; right: 0px; width: 60px; height: 60px;" class="zalo-chat-widget"data-welcome-message="Điện Máy Người Việt rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height="">
                    <img src="https://page.widget.zalo.me/static/images/2.0/Logo.svg">
                </div>
            </a>
        </div>    
          
            

        
        <!-- <div  class="zalo-chat-widget" data-oaid="1329456933344915716" data-welcome-message="Điện Máy Người Việt rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div> -->

         <!-- <script src="{{ asset('/js/zalo.js') }}"></script>  -->
       
        
        
 
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
   <!--  <script src="{{asset('js/tawto.js')}}"></script> -->
   
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
        
        // lazyload();

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

                    "number-phone-register": {
                        required: true,
                         phonenu: true,
                        
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
                        phone: $('#number-phone-customer').val(),
                        
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

        var close_popup =1; 

        // Select the element by class name
        const targetDiv = document.querySelector('.box-banner');

        if(close_popup==1){
            // Add a click event listener to the document
            document.addEventListener('click', (event) => {
                // Check if the clicked element is outside the target div
                if (!targetDiv.contains(event.target)) {
                    if ( typeof(Storage) !== "undefined") {
                   
                        sessionStorage.setItem('popup','1');
                       
                       
                    } else {
                        alert('Trình duyệt của bạn đã quá cũ. Hãy nâng cấp trình duyệt ngay!');
                    }
                    $('.box-promotion-active').hide();

                    close_popup=0;
                    
                }
            });

        }

        

       
    
    </script>

    </body>
</html>
