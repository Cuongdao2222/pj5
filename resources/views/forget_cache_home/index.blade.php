@extends('frontend.layouts.apps')

@section('content') 

    @push('style')

        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=22"> -->
  
       <!--  <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=4">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=9">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homecs.css') }}?ver=9">
 -->
        <style type="text/css">
           .gift-text span{
                color: #D82A20;
           }

           .container-productbox{
            overflow: hidden;
           }

           .div-pd{
            padding: 15px 0;
           }
           .__cate_1942 a:hover{
            text-decoration: none;
           }

           .pine-tree{
             display: none;
             
           }

           .list-mn, .footer{
                font-size: 14px !important;
            }


           @media screen and (max-width:776px) {

                .div-slide{
                    margin: 0 !important;
                }

                .box-div-slide{
                    padding: 0;
                }

                .cIVWIZ{
                    background-repeat: no-repeat;
                    background-size: 100%;
                    padding-top: 78px !important;
                }
                .btn-buys{
                    display: none;
                }
                .navbar-collapse{
                    display: flex;
                }
                #navbarNavAltMarkup {
                     height: auto !important; 
                }
                .items-title span{
                    font-size: 16px !important;
                }
                .btn-buy-price{
                    width: 100% !important;
                }
                 .div-pd a{
                    text-decoration: none;
                }

                .lists .item{
                    width: 100%;
                    overflow: hidden;
                }
                .lists{
                    padding-right: 0 !important;
                }


            }
        </style>


    @endpush

     <!-- check giá khuyến mãi sản phẩm để tạng voucher -->

    <?php 

        function pricesPromotion($price, $id)
        {

             if($id===''){

                $gift_Price = '';

            }
            else{
                if($price>=50000000){

                    $gift_Price = '1.000.000 đ';

                }
                elseif ($price>5000000 && $price<=10000000) {

                     $gift_Price = '100.000 đ';
                }

                elseif ($price>10000000 && $price<=30000000) {

                     $gift_Price = '200.000 đ';
                }

                elseif ($price>30000000 && $price<50000000) {

                    $gift_Price = '500.000 đ';
                }
                else{

                    $gift_Price = '50.000 đ';
                }
            }

            // tắt tính năng auto tính giá quà khuyến mãi

            $gift_Price = '';
            
            return $gift_Price;
        }

        
    ?>

     <?php


        if(!Cache::has('product_search')){

            $productss = App\Models\product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku', 'promotion', 'promotion_box')->where('active', 1)->get();

            Cache::forever('product_search',$productss);

        }    


        $hots = Cache::rememberForever('hots', function(){

            $hots = App\Models\hotsProduct::select('product_id')->get()->pluck('product_id');

            return $hots;
        });

        $new_product = Cache::rememberForever('new_product', function(){

            $new_product = App\Models\newProduct::select('product_id')->get()->pluck('product_id');

            return $new_product;
        });


        $now  = Carbon\Carbon::now();
        // $now  = \Carbon\Carbon::createFromDate('9-11-2022, 8:00');

        $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;
        $date_flashdeal = \Carbon\Carbon::create($date_string_flash_deal);

        $deal = Cache::get('deals')->sortByDesc('order');

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

        $smart_phone = false;

        $useragent=$_SERVER['HTTP_USER_AGENT']??'';

        if(!empty($useragent)){

            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

                $smart_phone = true;

            }

        }

        

        

       
    ?> 

   

    <style type="text/css">
        .price_market {
            display: inline-block;
            vertical-align: middle;
            margin-right: 4px;
            font-size: 12px;
            color: #707070;
            text-decoration: line-through;
        }

        .discount_percent {
            color: #fff;
            background: #007bff;
            display: inline-block;
            vertical-align: middle;
            padding: 2px 5px;
            font-size: 12px;
            border-radius: 4px;
        }

        .icons-tra-gops{
            background-color: #ddd;
            color: #000;
            border: none; 
        }
        .icons-promotion-per{
            height: 42px;
        }

        .listproduct{
                grid-gap:16px;
            }

        .left-banner{
            float: left;
        } 

        .homebanner .owl-stage-outer{
            width: 100%;
        }   
    </style>   

    <!-- <div class="locationbox__overlay"></div>
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
    </div> -->

    <section>


        <div class="row div-slide">
            <div class="col-md-2 left-banner"></div>
            <div class="col-md-10 box-div-slide">
                <div class="homebanner-container">
                    <!-- Banner chính -->
                    <aside class="homebanner">
                        <div id="sync1" class="slider-banner owl-carousel homebanners">

                            @if(isset($banners))

                            @foreach($banners as $value)
                            <div class="item" data-dot="<span>{{ $value->title }}</span>">
                                <a aria-label="slide" data-cate="0" data-place="1535" href="{{ $value->link }}" ><img  data-src="{{ asset($value->image) }}" alt="{{ $value->title }}" class="lazyload"></a>
                            </div>
                            @endforeach
                            @endif
                            
                        </div>
                        <div id="sync2" class="slider-banner owl-carousel">
                            @if(isset($banners))
                            @foreach($banners as $value)
                            <div class="item">
                                <h3>
                                    {{  $value->title }}
                                </h3>
                            </div>
                            @endforeach
                            @endif
                            
                        </div>
                    </aside>
                    <!-- End -->
                </div>
            </div>
        </div>
        
        
    </section>


   
    <!-- End -->
    <!-- Hiệu ứng ... rơi -->
    <div class="falling-container" aria-hidden="true">
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
        <!-- <div class="falling-item">
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
        </div> -->
    </div>
    <!-- End -->

    <div class="pine-tree"> 
        <img class="pine-tree-left " src="{{ asset('public/background/mai-tree.png')}}" data-was-processed="true"> 
        <img class="pine-tree-right " src="{{ asset('public/background/dao-tree.png')}}" data-was-processed="true"> 
        <!-- <img class="tuyet-left loading" src="{{ asset('public/background/Asset6@3x.png')}}" data-was-processed="true"> 
        <img class="tuyet-right loading" src="{{ asset('public/background/Asset7@3x.png')}}" data-was-processed="true">  -->
       <!--  <img class="santa-left loading" src="{{ asset('public/background/Asset4@3x.png')}}" data-was-processed="true"> 
        <img class="santa-right loading" src="{{ asset('public/background/Asset8@3x.png')}}" data-was-processed="true"> -->
    </div>

     <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @if (session('success'))


        <script type="text/javascript">
            swal({ title: '{{ session("success") }}', type: 'success' });
          
        </script>
        <?php
        Session::forget('success');
        ?>

        
    @endif


    @push('script')

    <style type="text/css">
        
    </style>


    <script type="text/javascript">
        if ($(window).width < 600){
            

            $('#navbarNavAltMarkup').removeClass('collapse');

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
       
        //  $('.sticky-sidebar').hide();
        // $(window).scroll(function (){

        //     if($(window).scrollTop()>$('.menus-banner').offset().top){


        //         var w = window.innerWidth;

        //         width = (w - 1200)/2;

        //         $('.sticky-sidebar').show();

        //         // $('#banner-left-scroll').css(leftClass);

        //         // $('#banner-right-scroll').css(rightClass);
               
        //     }
        //     else{
        //         $('.sticky-sidebar').hide();
        //     }

        // })   

        let ar_product = [];

        var group_id   = [];


        


        $('.compare-show').click(function() {

            id = $(this).attr('data-id');

            data_id = $(this).attr('data-group');

            // kiểm tra đã tick so sánh hay chưa

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
                    data_id:data_id,
                       
                },
                success: function(result){
                   $('#js-compare-holder').html('');
                   $('#js-compare-holder').append(result);
                }
            });         
            
          

            $('.global-compare-group').show();
        });


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

      
        loop = {{ $deal->count() }};


        times = [];
                  
      

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

        var number_slider =  parseInt($('.owl-slider-count').text());

        for (i = 0; i < number_slider; i++) {

            $('#banner-product_'+i).owlCarousel({
                
                margin:10,
                nav:false,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                loop: true,
                items:2,
                
                responsive:{
                   
                    600:{
                        items:3
                       
                    },
                    1000:{
                        items:5
                    }
                }
            });
            
        }


        $('#banner-sale-mobile').owlCarousel({
            loop:true,
            
            margin:10,
            nav:true,
            navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:2
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

        

        $('#sync1S').owlCarousel({
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

        function tracking(link){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('click-banner') }}",
                data: {
                    link: link,
                },
                success: function(result){
                    window.open(
                      link,
                      '_blank' 
                    );
                }
            });     

            
        }

        $('.optionsg').click(function(){
            
            var option = $(this).attr('data-id');
            choose = (option==0)?1:0;
            $('.optionsg').removeClass('active');
            $(this).addClass('active');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('showProductSaleMobile') }}",
                data: {
                    choose: choose,
                },
                success: function(result){
                    

                    $('.mobile-sale-product #banner-sale-mobile').remove();
                   
                   $('.mobile-sale-product').prepend(result);

                    var owl = $("#banner-sale-mobile");

                   

                    owl.owlCarousel({
                        loop:true,
            
                        margin:10,
                        nav:true,
                        navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                        responsive:{
                            0:{
                                items:2
                            },
                            600:{
                                items:2
                            },
                            1000:{
                                items:5
                            }
                        }
                    });



                }
            });


        })

        

        $('.option-sale').click(function(){
            
            var option = $(this).attr('data-id');
            $('.option-sg a').removeClass('active');
            choose = (option==0)?1:0;

            $(this).addClass('active');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('showProductSale') }}",
                data: {
                    choose: choose,
                },
                success: function(result){

                    $('.block-product__content ul').remove();
                   
                   $('.block-product__content').prepend(result);

                }
            });

        });


        function clickDeal(flash_deal_id, id, dem) {


                $('#navbarNavAltMarkup .navbar-nav').removeClass('actives');


                $('.active_'+id).addClass('actives');

                // classname =  $(this).attr('class');

                // $('.deal'+flash_deal_id+' h3').removeClass('actives-click');

                // $('.deal'+flash_deal_id+' .active_'+id).addClass('actives-click');

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
                        page:'index',
                        checksoon:{{ $checksoon??1 }}
                           
                    },
                    success: function(result){
                       // numberCart = result.find($("#number-product-cart").text());

                       $('.listpd').remove();

                       // console.log(result);

                       $('.container-productbox').prepend(result);


                        // var owl = $('.deal-view'+flash_deal_id+' .flash-sale-banner');
                        // owl.owlCarousel({
                        //     loop:false,
                        //     margin:10,
                        //     nav:true,
                        //     dots:false,
                        //     autoplay:false,
                            
                        //     navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa fa-angle-right'></i>"],
                        //     responsive:{
                        //         0:{
                        //             items:2
                        //         },

                        //          600:{
                        //             items:2
                        //         },
                               
                        //         1000:{
                        //             items:4
                        //         }
                        //     }
                        // });
                    }
                });    
            }
        
    </script>


  
    @endpush
@endsection      
