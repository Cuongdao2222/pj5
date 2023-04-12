<?php 
            
    $post = Cache::rememberForever('post_home', function() {
        return App\Models\post::where('active',1)->where('hight_light', 1)->OrderBy('created_at', 'desc')->select('link', 'title', 'image')->limit(7)->get()->toArray();
    });

    $post_promotion = Cache::rememberForever('post_promotion', function() {
        return App\Models\post::where('active',1)->where('hight_light', 1)->where('category', 11)->OrderBy('created_at', 'desc')->select('link', 'title')->limit(2)->get();
    });

    $post_advice = Cache::rememberForever('post_advice', function() {
        return App\Models\post::where('active',1)->where('hight_light', 1)->where('category', 8)->OrderBy('created_at', 'desc')->select('link', 'title')->limit(2)->get();
    });
       
?>

@extends('frontend.layouts.apps')

@section('content') 

    @push('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=26">
  
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=4">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=10">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homecs.css') }}?ver=15">

    @endpush

     <!-- check giá khuyến mãi sản phẩm để tạng voucher -->

    
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


        $date_string_flash_deal = Cache::rememberForever('date_flash_deal', function(){

            $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date;

            return  $date_string_flash_deal;
        });


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

    <section>


        <div class="row div-slide">
            <div class="col-md-2 left-banner"></div>
            <div class="col-md-7 box-div-slide">
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

            @if(!$smart_phone)

            <?php 

            ?>

            <div class="col-md-3 box-div-slide1">
                <div class="top-image">

                    <div class="homenews">
                        <span><a href="{{ route('details', 'tin-tuc-khuyen-mai') }}">Tin tức khuyến mãi</a></span>
                        <ul>

                            @if($post_promotion->count()>0)

                            @foreach($post_promotion as $value)

                            <li>
                                <a href="{{ route('details', $value->link) }}">{{ @$value->title }}</a>
                            </li>

                            @endforeach

                            @endif

                          
                        </ul>
                    </div>


                   
                </div>

                <div class="homenews">
                    <span><a href="{{ route('details', 'tu-van-mua-sam') }}">Tư vấn tiêu dùng</a></span>
                    <ul>
                         @if($post_advice->count()>0)

                            @foreach($post_advice as $value)

                            <li>
                                <a href="{{ route('details', $value->link) }}">{{ @$value->title }}</a>
                            </li>

                            @endforeach

                            @endif
                    </ul>
                </div>

            </div>
            @endif
        </div>
        
        
    </section>


    <section>

        <div class="bar-top">
           <!--  <div class="bar-top-left-none"></div> -->
           
            <div class="preorder-hot"> 
                @if(isset( $bannersRight ))

                @foreach( $bannersRight as $values)

                <a  aria-label="slide" data-cate="0" data-place="1539" href="{{ $values->link }}">
                    <img   data-src="{{ asset($values->image) }}"  alt="{{ $values->title }}" class="lazyload">
                </a>
                @endforeach
                @endif
            </div>
        </div>
        <!-- <section class="menus-banner">
            <strong class="name-box">Có thể bạn quan tâm</strong>
            <ul>

                @if(!empty($bannerUnderSlider))
                @foreach($bannerUnderSlider as $slider)
                <li class="col-">
                    <a href="{{ $slider->link }}">
                        <picture>
                            <source media="(min-width:1201px)" >
                            <img  data-src="{{ asset($slider->image) }}" class="lazyload">
                        </picture>
                    </a>
                    <p>
               &nbsp; <a href="{{ $slider->link }}">{{ $slider->title }}</a></p>
                    
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ $slider->link }}"><strong class="strongtitle">{{ @$slider->slogan }}</strong>
                    @if(!empty($slider->slogan))
                    <span aria-label="Next" class="Next">›</span>
                    @endif
                   </a>
                </li>
                @endforeach
                @endif
               
            </ul>
        </section> -->
        <?php 
           
           

            if(!empty($deal)){

                $timeDeal_star =$deal->first()->start;

                $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);

                $timeDeal_end = $deal->first()->end;

                $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);

                $timestamp = $now->diffInSeconds($timeDeal_end);
            }

            

        ?>

        @if($date_flashdeal->isToday())

        <?php 
            $saleFlash = DB::table('flash_deal')->get();
        ?>

        @foreach($saleFlash as $keys => $vals)

        
        @if($now < $time4)


            <?php 

                $groups_deal = 0;
                $k = 0;

            ?>
           
            <a href="{{ route('show-flash-deal') }}" target="_blank"><div class="container cIVWIZ" style="background-image: url(https://dienmaynguoiviet.vn/uploads/banner/1668001535_9ec673f17e637893c11a2a983045e7c6.jpg);"></div></a>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
       
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                    <?php 

                        $flashDeal = App\Models\flashdeal::where('flash_deal_id', $vals->id)->where('flash_deal_time_id', 1)->where('active',1)->OrderBy('order','desc')->take(4)->get();

                       // Khi chưa đến giờ flashdeal kiểm tra để hiển thị deal

                        $checksoon = 1;
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


                                $flashDeal = App\Models\flashdeal::where('flash_deal_id', $vals->id)->where('flash_deal_time_id', $groups_deal)->where('active',1)->OrderBy('order','desc')->take(4)->get();
                                $checksoon = 0;

                            }

                    ?>  

                   
                    <div class="navbar-nav col-md-3 {{  $k==1?'actives':'' }} active_{{ $key+1 }}">
                        <div class="nav-item nav-link active div-pd" > 
                            <div>
                                <a class="deal{{ $vals->id }}" href="javascript:void(0)" onclick="clickDeal({{ $vals->id }},{{ $key+1 }}, {{ $k }})">
                                    <div class="UCDJ9O">{{ $value['start'] }}</div>
                                    <div class="higiZo">{{ $now->between($value['startTime'], $value['endTime'])?'Đang diễn ra':'sắp diễn ra'}}</div>
                                </a>
                            </div>
                        </div>


                    </div>

                     @endif
                    @endforeach
                   
                </div>
            </nav>

           

        <div class="container-productbox product-view-all">

            <div class="row list-pro listpd">


                @if(!empty($flashDeal) && $flashDeal->count()>0)
                @foreach($flashDeal as $key => $value)

                                
                <div class="col-md-3 col-6 lists">
                    <div class="item  __cate_1942">
                       
                            
                            <div class="item-img item-img_1942">  <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain" target="_blank"> <img class="thumb lazyloaded" data-src="{{ asset($value->image) }}" alt="{{ $value->name }}" style="width:auto; height: 184px;" src="{{ asset($value->image) }}" ></a> </div>
                            <div class="items-title">
                                <div class="name">
                                     <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain" target="_blank">    
                                         <span> {{ $value->name }} </span>
                                     </a>
                                </div>

                                <div class="IKgh3U"><div class="qOgYxF"><span>{{ @str_replace(',' ,'.', number_format($value->price)) }}</span><span class="-92Xgq">₫ </span></div></div>
                                <div class="price-sale">
                                    <div class="btn-buy-price">

                                        <?php 
                                            $str_len[7] = '?.???.000';
                                            $str_len[8] = '??.???.000';
                                            $str_len[9] = '???.???.000';
                                        ?>

                                         @if($vals->price !=0)
                                        <strong class="price">{{ $checksoon ==1?'???.000':@str_replace(',' ,'.', number_format($vals->price)) }}&#x20AB</strong>
                                         @else

                                         <?php 
                                            $price_strlen = $str_len[strlen($value->deal_price)]??'???.000';
                                         ?>
                                         <strong class="price">{{   $checksoon ==1 ?$price_strlen:@str_replace(',' ,'.', number_format($value->deal_price)) }} &#x20AB</strong>
                                         @endif
                                        <div class="progress">

                                            <div class="progress-done" data-done="70">
                                                70%
                                            </div>
                                        </div>

                                    </div>
                                    <div class="btn-buys">
                                        <button type="button" class="btn btn-danger btn-buy-click" onclick="addToCart('{{ $value->product_id }}')">Mua ngay</button>
                                    </div>
                                    
                                </div>
                                
                               
                            </div>
                        
                        <div class="item-bottom"> <a href="#" class="shiping"></a> </div>

                        @if($checksoon==0)

                        <?php 
                            $percent = floor((intval($value->price)- intval($value->deal_price))/intval($value->price)*100);


                        ?>

                        @if($percent>0)
                        <div class="_5ICO3M yV54ZD X7gzZ7">
                            <div class="_8PundJ"><span class="percent">{{ $percent }}%</span><span class="tSV5KQ">giảm</span></div>
                        </div>
                        @endif
                        @endif
                        <!-- <a href="javascript:void(0)" class="item-ss"> <i></i> So sánh </a> --> 
                    </div>
                </div>

                @endforeach
                @endif
            </div>
            <div class="clearfix"></div>
            <div class="prd-promo__top clearfix"> <a class="readmore-btn" href="{{ route('show-flash-deal') }}" target="_blank"><span>Xem tất cả</span></a> </div>
            <!-- <div class="view-more "> <a href="javascript:;">Xem thêm <span class="remain">133</span> Tivi</a> </div> --> 
        </div>

        @endif
        @endforeach



        @else

        <?php 
            $deal_active = 1;

            $ar_Deal_Pd = [];
        ?>

        @if(!empty($deal_check) && $deal_check->count()>0 && $now->between($deal_check[0]->start, $deal_check[0]->end) && $deal_active ===1)

        <!-- flash sale -->
            <div class="img-flashsale mobiles" style="width: 100%;">
                <a href="{{ route('details', 'deal') }}"><img src="{{ asset('images/template/flashsalemb.jpg') }}" style="width: 100%"></a>

            </div>
           
            <div class="mt-1">
                <div class="flash-sale" style="height: 305px;">
                    
                    <span id="banner-flash-sale"><a href="{{ route('dealFe') }}">
                    <img width="256" src="{{  asset('images/background-image/Flash_Sale_Theme_256x396.jpg')}}" style="width: auto; height: 300px" alt="banner-fs">
                    </a></span>
                    <div class="flash-product nk-product-of-flash-sales">
                        <div class="col-flash col-flash-2 active">
                            <div id="sync1S" class="slider-banner owl-carousel flash-sale-banner">

                                @foreach($deal as $key => $value)
                               
                                @if( !empty($value->active) && $value->active ==1 && $now->between($value->start, $value->end))

                                <?php 
                                    $timestamp = $now->diffInSeconds($value->end);
                                    $hour =  floor($timestamp/3600);
                                    $timestamp = floor($timestamp % 3600);
                                    $minutes =floor($timestamp/60);
                                    $timestamp = floor($timestamp % 60);
                                    $seconds =floor($timestamp);

                                    $ar_Deal_Pd[$value->product_id] = $value->deal_price;
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
                                                       &nbsp

                                                       <?php
                                                            $discount_deal =  round(((intval($value->price) - intval($value->deal_price))/intval($value->price))*100)
                                                        ?>
                                                        
                                                        <span class="discount_percent">-{{ $discount_deal }}%</span>
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
                                            <div class="countdown-flash-sale">
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
                                            </div>
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

           <!--  end flash  -->
         @endif 

         @endif
          
        <div class="clearfix"></div> 

     
        <div class="prd-promo has-banner" style="background: #eb3a7f;" data-html-id="3109">

            @if(!empty($bannerUnderSale[0]['image']))

            <div class="prd-promo__top clearfix" >

                <a data-cate="0" data-place="1868" href="#" ><img style="cursor:pointer" src="{{ asset($bannerUnderSale[0]['image']) }}" alt="banner-summer" width="1200"></a>                
            </div> 

            @endif


           @if(!empty($product_sale)&&$product_sale->count()>0)

           @if(!$smart_phone)
           <div class="option-sg">

                <a href="javascript:;" data-is-recommend-tab="true" class="active option-sale" data-id="0">
                    <img data-src="{{ asset('background/like2.png') }}" class=" ls-is-cached lazyloaded" alt="Cho bạn" width="50" height="50" src="{{ asset('background/like2.png') }}">
                    <span>Cho bạn</span>
                </a>

                <a href="javascript:;" data-campaign="282" data-group="3507"  class="option-sale" data-id="1">
                    <img data-src="{{ asset('background/like1.png') }}" class=" ls-is-cached lazyloaded" alt="Sản phẩm luxury" width="50" height="50" src="{{ asset('background/like1.png') }}">
                    <span>Sản phẩm Luxury</span>
                </a>
                
            </div>

            @else

            <div class="option-mbile-sg">
                <div>
                    <button class="btn btn-primary optionsg active" data-id="0"><span>Cho bạn</span></button>
                </div>

                <div class="ml-2">
                    <button class="btn btn-primary optionsg" data-id="1"><span>Sản phẩm Luxury</span></button>
                </div>
   
            </div>

            @endif
            
            <div class="block-product__content mobile-sale-product" data-is-recommend-tab="true">

                @if($smart_phone ===true)

                <div class="listproduct slider-promo owl-carousel banner-sale" id="banner-sale-mobile" data-size="20">

                @foreach($product_sale as  $value)
                @if($value->active==1)
                <div class="item">
                    
                    <a href='{{ route('details', $value->Link) }}' class=" main-contain" data-s="OnlineSavingCMS" data-site="2" data-pro="3" data-cache="False" data-name="M&#xE1;y gi&#x1EB7;t LG Inverter 8.5 kg FV1408S4W" data-id="227121" data-price="8840000.0" data-brand="LG" data-cate="M&#xE1;y gi&#x1EB7;t" data-box="BoxHome">
                        <div class="item-label">
                        </div>
                        <div class="item-img">
                            <img data-src="{{ asset($value->Image) }}"   class="lazyload"  data-src="{{ asset($value->Image) }}" alt="{{ $value->Name }}" width=210 height=210>
                        
                        </div>
                        <div class="title-name">
                            <h3>{{ $value->Name }}</h3>
                        </div>

                        <?php 

                            $check_deal_sale = $deal->where('product_id', $value->product_id)->first();

                            if(!empty($check_deal_sale) && $now->between($deal[0]->start, $deal[0]->end)){

                                $value->Price = $check_deal_sale->deal_price;
                            }
                           
                        ?>
                        
                        <strong class="price">{{  @str_replace(',' ,'.', number_format($value->Price))  }}.&#x20AB;</strong>
                        <div class="item-rating">
                            <p>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </p>
                        </div>
                    </a>

                    <?php  

                            if(!Cache::has('gifts_Fe_'.$value->id)){

                                $gifts = gift($value->product_id);
                                
                                
                                Cache::put('gifts_Fe_'.$value->product_id, $gifts,100);

                            }
                            
                            $gift = Cache::get('gifts_Fe_'.$value->product_id);



                        ?>

                        <!-- // Trường hợp  đang chạy sự kiện -->

                        <?php 

                        $gift_Price = pricesPromotion($value->Price, $value->id);

                        ?>

                        @if(!empty($gift_Price))
                        <?php 

                            $image_gift_promotion = definePrice($gift_Price);
                        ?>

                         <div class="option-gift">
                            
                            <div class="quatang"><img src="{{ $image_gift_promotion }}"></div>
                           
                        </div>

                        <div class="font-sz">
                            <span> Giảm ngay <strong>{{ $gift_Price  }} đ</strong> </span>
                        </div>

                        @endif

                        @if(!empty($gift))
                            <?php 
                                $gifts = $gift['gifts'];
                                $gift = $gift['gift']; 
                               
                            ?>

                            {{ $gifts->type ==1?'k/m chọn 1 trong 2':'' }}
                            <div class="option-gift">

                                 @foreach($gift as $gifts)

                                <div class="quatang"><img src="{{ asset($gifts->image) }}"></div>
                                @endforeach
                            </div>

                            @if(!empty($gifts->price))

                            <?php 

                                $id_checkpromotion = $value->promotion_box==1?'':$value->id;

                                $price_gift = pricesPromotion($value->Price, $id_checkpromotion)===''?str_replace(',' ,'.', number_format($gifts->price)):pricesPromotion($value->Price, $id_checkpromotion);

                            ?>

                            <span> Quà tặng trị giá <strong>{{  $price_gift }}  </strong> </span>
                            @endif  
                        @endif
                    <a href="javascript:void(0)" class="compare-show" data-id="{{ $value->product_id }}">
                        <i class="fa-solid fa-plus"></i>
                            so sánh
                    </a>
                </div>
                @endif

                @endforeach
                </div>


                @else
                <ul class="listproduct" data-total="39">
                    @foreach($product_sale as $keys => $value)
                    @if($value->active==1)

                    <li data-id="{{ $keys }}" data-pos="1" class="item ">
                        <a href='{{ route('details', $value->Link) }}' class=" main-contain" data-s="OnlineSavingCMS" data-site="2" data-pro="3" data-cache="False" data-name="M&#xE1;y gi&#x1EB7;t LG Inverter 8.5 kg FV1408S4W" data-id="227121" data-price="8840000.0" data-brand="LG" data-cate="M&#xE1;y gi&#x1EB7;t" data-box="BoxHome">
                            <div class="item-label">
                            </div>
                            <div class="item-img">
                                <img data-src="{{ asset($value->Image) }}"   class="lazyload"  data-src="{{ asset($value->Image) }}" alt="{{ $value->Name }}" width=210 height=210>
                            
                            </div>
                            <div class="title-name">
                                <h3>{{ $value->Name }} {{ $value->product_id }}</h3>
                            </div>

                            <?php 

                                $check_deal_sale = $deal->where('product_id', $value->product_id)->first();

                                
                                if(!empty($check_deal_sale) && $now->between($deal[0]->start, $deal[0]->end)){

                                    $value->Price = $check_deal_sale->deal_price;

                                }
                            ?>
                            
                            <strong class="price">{{  @str_replace(',' ,'.', number_format($value->Price))  }}.&#x20AB;</strong>
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>
                            </div>
                        </a>

                        <?php  

                            if(!Cache::has('gifts_Fe_'.$value->id)){

                                $gifts = gift($value->product_id);
                                
                                
                                Cache::put('gifts_Fe_'.$value->product_id, $gifts,100);

                            }
                            
                            $gift = Cache::get('gifts_Fe_'.$value->product_id);



                        ?>

                        @if(!empty($gift))
                            <?php 
                                $gifts = $gift['gifts'];
                                $gift = $gift['gift']; 
                               
                            ?>

                            {{ $gifts->type ==1?'k/m chọn 1 trong 2':'' }}


                            <div class="option-gift">

                                 @foreach($gift as $gifts)

                                <div class="quatang"><img src="{{ asset($gifts->image) }}"></div>
                                @endforeach
                            </div>

                            @if(!empty($gifts->price))
                            <?php 

                                $id_checkpromotion = $value->promotion_box==1?'':$value->id;

                                $price_gift = pricesPromotion($value->Price, $id_checkpromotion)===''?str_replace(',' ,'.', number_format($gifts->price)):pricesPromotion($value->Price, $id_checkpromotion);

            
                            ?>

                            <div class="font-sz">    
                                <span> Quà tặng trị giá <strong>{{  $price_gift }} </strong> </span>
                            </div>
                            @endif  

                         

                        @endif



                        <!-- phần quà khuyến mãi -->


                        <?php 

                        $gift_Price = pricesPromotion($value->Price, $value->id);

                        ?>

                        @if(!empty($gift_Price))

                        <?php 

                            $image_gift_promotion = definePrice($gift_Price);
                        ?>

                         <div class="option-gift">
                            
                            <div class="quatang"><img src="{{ $image_gift_promotion }}"></div>
                           
                        </div>
                      

                        <div class="font-sz">
                            <span> Giảm ngay <strong>{{ $gift_Price  }} đ</strong> </span>
                        </div>

                        @endif

                       

                        <a href="javascript:void(0)" class="compare-show" data-id="{{ $value->product_id }}">
                            <i class="fa-solid fa-plus"></i>
                                so sánh
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @endif


                <div class="prd-promo__top clearfix" >
                    <a class="readmore-btn" href="{{ route('sale-home') }}"><span>Xem tất cả</span></a>                
                </div>
            </div>
            @endif

            
            
        </div>
        

        <div  class="owl-slider-count" style="display: none;">{{ @$group->count() }}</div> 
        <?php
            $defineBannerGr = [0=>6, 1=>7, 2=>8, 3=>9, 6=>10, 7=>11];

         ?>

        @foreach($group as $key => $groups)

            <?php
               
                $hot = Cache::rememberForever('hot'.$groups->id, function() use($groups){

                    $hot = DB::table('hot')->select('product_id')->where('group_id', $groups->id)->orderBy('orders', 'asc')->get()->pluck('product_id');

                    return $hot;

                    
                });

                // xử lý khi không có cache

                if(Cache::has('product_search'))
                {
                    $data = Cache::get('product_search')->whereIn('id', $hot->toArray())->sortByDesc('orders_hot');
                }
                else{

                    $productss = App\Models\product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku', 'promotion', 'promotion_box')->where('active', 1)->get();

                    Cache::forever('product_search',$productss);

                    $data = Cache::get('product_search')->whereIn('id', $hot->toArray())->sortByDesc('orders_hot');
                }
               


            ?>

        @if(!empty($data) && $data->count()>0)

        <?php 
            if(!empty($defineBannerGr[$key])){
                $banners_group = Cache::rememberForever('banners_groups__'.$defineBannerGr[$key], function() use($defineBannerGr, $key){

                    $banners_group = App\Models\banners::where('option', $defineBannerGr[$key])->where('active', 1)->get();

                    return $banners_group;
                });
            }

        ?>
         @if($banners_group->count()>0)

        <div class="banner"> 
            @foreach($banners_group as $value)
            <a href="{{ $value->link }}" title="{{ $value->title }}" class="item" target="_self"> 
                <img src="{{ asset($value->image) }}" data-src="{{ asset($value->image) }}" class="lazy loaded" alt="{ $value->title }}" data-was-processed="true"> 
            </a> 
            @endforeach
            
        </div>
        @endif

        <div class="box-common _cate_1942">
            <ul class="box-common__tab box-tab-mobile">
                <li class="active-tab" data-cate-id="1942"><a href="{{  @$groups->link }}">{{  @$groups->name }}</a></li>
                <?php

                    $listGroupsShows = Cache::rememberForever('listGroupsShow'.$groups->id, function() use($groups){

                         $listGroupsShow =   App\Models\groupProduct::select('name', 'link')->where('parent_id', $groups->id)->take(4)->get();

                        return $listGroupsShow??'';
                    });
                ?>

                @if(!empty($listGroupsShows) && $listGroupsShows->count()>0)

                @foreach($listGroupsShows as $valueslist)

            
                <li data-cate-id="2162" data-prop-value-ids="90016" class="desk-t"><a href="{{ route('details', $valueslist->link) }}">
                    {{ @str_replace('quần áo', '', $valueslist->name)  }}</a></li>
                @endforeach
                @endif
            </ul>
            <div class="box-common__main relative">
                <div class="preloader">
                    <div class="loaderweb"></div>
                </div>
                <div class="box-common__content">
                    <div class="listproduct slider-home owl-carousel" id="banner-product_{{ $key }}" data-size="10">

                        @foreach($data as $datas)

                        <div class="item"  data-pos="1">
                            <a href='{{ route('details', $datas->Link) }}'>
                                @if($datas->Price>=3000000)
                                <span class="icon_tragop icons-tra-gops">Trả góp <i>0%</i></span>
                                @endif

                                @if(in_array($datas->id, $new_product->toArray()))
                                <span class="icon_tragop icons-new">Model 2022</span>
                                @endif
                                
                                <div class="item-img">
                                    <img data-src="{{ asset($datas->Image) }}" class="lazyload"   alt="{{ $datas->Name }}" width=210 height=210>
                                    
                                </div>

                                @if(in_array($datas->id, $hots->toArray()))
                                <p class="result-labels"><img class="sale-banner ls-is-cached lazyloaded" alt="hot" data-src="{{ asset('images/background-image/i-con-hot.gif') }}" src="{{ asset('images/background-image/i-con-hot.gif') }}"></p>
                                @else
                                <div style="height: 30px;"></div>
                                @endif

                               <div class="title-name">
                                    <h3>{{ $datas->Name }}</h3>
                                </div>
                                @if($groups->id<5)
                                <?php
                                        if($groups->id == 1){
                                            $searchstring = 'inch';
                                        }
                                        else{
                                            $searchstring = 'inverter';

                                        }
                                       
                                    $infoName  = str_replace($datas->ProductSku,'', strstr($datas->Name, $datas->ProductSku));
                                    if(!empty($infoName)){

                                        $arNames = [];
                                        if(strpos($datas->Name, $searchstring)){

                                            $arNames = explode($searchstring, $infoName);

                                        }
                                    }
                                ?>
                               
                                <div class="item-compare">
                                    @if(!empty($arNames))
                                    <span>{{ @$arNames[0] }} {{ !empty($arNames)?$searchstring:'' }}</span>
                                    <span>{{ @$arNames[1] }}</span>
                                    @endif
                                    
                                </div>
                                
                                @endif
                                <div class="icons-promotion-per">
                                    <strong class="price">{{ @number_format(!empty($ar_Deal_Pd[$datas->id])?$ar_Deal_Pd[$datas->id]:$datas->Price , 0, ',', '.')}}&#x20AB;</strong>

                                    @if(!empty($datas->manuPrice))

                                    <?php
                                    $discount =  round(((intval($datas->manuPrice) - intval($datas->Price))/intval($datas->manuPrice))*100)
                                    ?>
                                    
                                    <span class="price_market">{{ @number_format($datas->manuPrice , 0, ',', '.')}} <sup>đ</sup></span>

                                    <span class="discount_percent">-{{ $discount }}%</span>

                                    @endif

                                </div>
                                
                           
                                <div class="item-rating">
                                    <p>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </p>
                                </div>

                                <?php  

                                    if(!Cache::has('gifts_Fe_'.$datas->id)){

                                        $gifts = gift($datas->id);
        

                                        if(empty($gifts)){
                                            $gifts = groupGift($groups->id);
                                            
                                            if(empty($gifts)){

                                                $gifts =[];
                                            }
                                        }
                                        Cache::put('gifts_Fe_'.$datas->id, $gifts,100);

                                    }
                                   
                                    $gift = Cache::get('gifts_Fe_'.$datas->id);
                                ?>


                            </a>


                             <!-- phần quà khuyến mãi 1-->

                           <?php 

                            $gift_Price = pricesPromotion($datas->Price, $datas->id);

                            ?>

                            @if(!empty($gift_Price))

                            <?php 

                                $image_gift_promotion = definePrice($gift_Price);
                            ?>

                             <div class="option-gift">
                                
                                <div class="quatang"><img src="{{ $image_gift_promotion }}"></div>
                               
                            </div>
                            

                            <div class="font-sz">
                                <span> Giảm ngay <strong>{{ $gift_Price  }} đ</strong> </span>
                            </div>

                            @endif


                            <!-- end -->
                           

                            <a href="javascript:void(0)" class="compare-show" data-id="{{ $datas->id }}" data-group="{{ $groups->id }}">
                                <i class="fa-solid fa-plus"></i>
                                    so sánh
                            </a>

                            @if(!empty($gift))
                                <?php 
                                    $gifts = $gift['gifts'];
                                    $gift = $gift['gift']; 
                                   
                                ?>

                                {{ $gifts->type ==1?'k/m chọn 1 trong 2':'' }}
                                <div class="option-gift">

                                     @foreach($gift as $gifts)

                                    <div class="quatang"><img src="{{ asset($gifts->image) }}"></div>
                                    @endforeach
                                </div>

                                @if(!empty($gifts->price))


                                <?php 

                                $id_checkpromotion = $datas->promotion_box==1?'':$datas->id;

                                $price_gift = pricesPromotion($datas->Price, $id_checkpromotion)===''?str_replace(',' ,'.', number_format($gifts->price)):pricesPromotion($datas->Price, $id_checkpromotion);

                                ?>


                                <span> Quà tặng trị giá <strong>{{  $price_gift }} </strong> </span>
                               
                                @endif  

                            @endif

                            @if(!empty($datas->promotion))
                                <div class="gift-text mt-2">
                                    <span>Có 1 khuyến mãi</span>
                                </div>

                            @endif

                        </div>
                        
                        @endforeach
                    
                    </div>
                    <a class="readmore-txt blue" href="{{ route('details', @$groups->link)  }}"><span>Xem tất cả</span></a>
                </div>
            </div>
        </div>

       
        @endif
        @endforeach
        <!-- End  -->

        @if(!empty($bannerscrollRight) && !empty($bannerscrollLeft))
        <!-- Banner dọc 2 bên -->
        <div class="sticky-sidebar">
            <a data-cate="0" data-place="1863" href="{{ $bannerscrollLeft->link }}" class="banner-left" id="banner-left-scroll">
                <img style="cursor:pointer; height:auto;" src="{{ asset($bannerscrollLeft->image) }}" alt="Theme Giáng Sinh Trái" width="179" height="271">
            </a>
            <a data-cate="0" data-place="1864" href="{{ $bannerscrollRight->link }}" class="banner-right" id="banner-right-scroll"><img style="cursor:pointer; height:auto;" src="{{ asset($bannerscrollRight->image) }}" alt="Theme Giáng Sinh Phải"></a>        
        </div>
        @endif
        
        @if(isset($post) && count($post)>0)

        <div class="my_utilities">
            <p class="title_pro news-home">Tin tức nổi bật </p>

            <br>
           
            <div class="videos">
                <a href="{{ route('details', $post[0]['link']) }}" class="video_big not_video " title="{{ $post[0]['title'] }}" idx="5229">
                    <div class="img_video"> <img src="{{ asset($post[0]['image']) }}" data-src="{{ asset($post[0]['image']) }}" alt="Iphone lock là gì? Các cách kiểm tra Iphone lock dễ dàng" class="lazy loaded" style="width: 100%;" data-was-processed="true"> </div>
                    <div class="title_video">
                        <h3> <span>{{ $post[0]['title'] }}</span> </h3>
                    </div>
                </a>

                <div class="video_small">

                    @for($i=1; $i<count($post); $i++)

                        <a href="{{ route('details', $post[$i]['link']) }}" class="video_small_item not_video " title="{{ $post[$i]['title'] }}" idx="5228">
                            <div class="img_video"> <img src="{{ asset($post[$i]['image']) }}" data-src="{{ asset($post[$i]['image']) }}" class="lazy loaded" alt="{{ $post[$i]['title'] }}" data-was-processed="true"> </div>
                            <div class="title_video">
                                <h3> <span>{{ $post[$i]['title'] }}</span> </h3>
                            </div>
                        </a>

                    @endfor
                   
                </div>
            </div>
        </div>
        @endif
                    

        <div class="bottom-search">
            <p>Tìm kiếm nhiều:</p>

            <?php 
                if(empty(Cache::get('link_much'))){
                    $links=   DB::table('muchsearch')->get(); 

                    Cache::put('link_much',  $links, 10000);
                }
              
                $link = Cache::get('link_much');

             ?>

            @isset($link)
            @foreach($link as $links)
            <a href="{{ $links->link }}" target="_blank">• {{@$links->title  }}</a> 
            @endforeach
            @endif
        
        </div>
        
    </section>
    <!-- End -->
    <!-- Hiệu ứng ... rơi -->

    <?php 


        $event_check = Cache::rememberForever('events-show', function(){

            $event_check = App\Models\events::find(1);

            return $event_check;
        });

       

    ?>

    @if($event_check->active===1)
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
    @endif
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


    @if (session('status-login'))


        <script type="text/javascript">
            swal({ title: '{{ session("status-login") }}', type: 'error' });
          
        </script>
        <?php
        Session::forget('status-login');
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
                  
        time = {{ $timestamp }};
        number_deal_product =10;
        //in time 
      
        setInterval(function(){
            for (var i = 0 ; i < loop; i++) {
                run(i);
            }

        }, 1000);

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

            if(option===1){
                $('.prd-promo .readmore-btn').attr('href', '{{ route('details', 'sale') }}');
            }
            else{
                 $('.prd-promo .readmore-btn').attr('href', '{{ route('details', 'combo') }}');
            }

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


   <!--   <script type="text/javascript">
            


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
        </script> -->
    @endpush
@endsection      
