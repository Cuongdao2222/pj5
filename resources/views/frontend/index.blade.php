@extends('frontend.layouts.apps')

@section('content') 
    @push('style')

        <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=21">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=22"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}?ver=3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homes.css') }}?ver=8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homecs.css') }}?ver=8">
    @endpush

     <?php


        if(!Cache::has('product_search')){

            $productss = App\Models\product::select('Link', 'Name', 'Image', 'Price', 'id', 'ProductSku')->where('active', 1)->get();

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
    </style>   

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

                @if(isset($banners))

                @foreach($banners as $value)
                <div class="item" data-dot="<span>{{ $value->title }}</span>">
                    <a aria-label="slide" data-cate="0" data-place="1535" href="{{ $value->link }}" ><img  src="{{ asset($value->image) }}"  data-src="{{ asset($value->image) }}" alt="{{ $value->title }}"></a>
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
    
    <section>

        <div class="bar-top">
           <!--  <div class="bar-top-left-none"></div> -->
           
            <div class="preorder-hot"> 
                @if(isset( $bannersRight ))

                @foreach( $bannersRight as $values)

                <a  aria-label="slide" data-cate="0" data-place="1539" href="{{ $values->link }}">
                    <img  src="{{ asset($values->image) }}" data-src="{{ asset($values->image) }}"  alt="{{ $values->title }}" >
                </a>
                @endforeach
                @endif
            </div>
        </div>
        <section class="menus-banner">
            <strong class="name-box">Có thể bạn quan tâm</strong>
            <ul>

                @if(!empty($bannerUnderSlider))
                @foreach($bannerUnderSlider as $slider)
                <li class="col-">
                    <a href="{{ $slider->link }}">
                        <picture>
                            <source media="(min-width:1201px)" >
                            <img src="{{ asset($slider->image) }}" alt="" data-src="{{ asset($slider->image) }}">
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
        </section>
        <?php 
           
           

            if(!empty($deal)){

                $timeDeal_star =$deal->first()->start;

                $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);

                $timeDeal_end = $deal->first()->end;

                $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);

                $timestamp = $now->diffInSeconds($timeDeal_end);
            }

        ?>

        @if(!empty($deal_check) && $deal_check->count()>0 && $now->between($deal_check[0]->start, $deal_check[0]->end))
        <!-- flash sale -->
            <div class="img-flashsale mobiles" style="width: 100%;">
                <a href="{{ route('details', 'deal') }}"><img src="{{ asset('images/template/flashsalemb.jpg') }}" style="width: 100%"></a>

            </div>
           <!--  <div class="title titles-time">
                <h3>
                    <span>12:00</span>
                    <br>
                    <span>01:00:59</span>
                </h3>
                
                <ul class="cat-child">
                    <li>
                        <h3>
                            <span>15:00</span>
                            <br>
                            <span>Sắp diễn ra</span>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <span>18:00</span>
                            <br>
                            <span>Sắp diễn ra</span>
                        </h3>

                    </li>
                    <li>
                        <h3>
                            <span>21:00</span>
                            <br>
                            <span>Sắp diễn ra</span>
                        </h3>
                    </li>
                </ul>
            </div> -->

            <div class="">
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
          
        <div class="clearfix"></div> 

        <div class="prd-promo has-banner" style="background: #DC00BD;;" data-html-id="3109">

            <div class="prd-promo__top clearfix" >

                <a data-cate="0" data-place="1868" href="#" ><img style="cursor:pointer" src="{{ asset($bannerUnderSale[0]['image']) }}" alt="banner-summer" width="1200"></a>                
            </div>
           
           @if(!empty($product_sale)&&$product_sale->count()>0)
           
            <div class="listproduct slider-promo owl-carousel banner-sale" id="banner-sale" data-size="20">

                @foreach($product_sale as  $value)
                @if($value->active==1)
                <div class="item">
                    <span class="icon_sale">
                        <img class="sale-banner ls-is-cached lazyloaded" alt="hot" data-src="{{ asset('images/background-image/xahang.png') }}" src="{{ asset('images/background-image/xahang.png') }}">
                    </span>
                    <a href='{{ route('details', $value->Link) }}' class=" main-contain" data-s="OnlineSavingCMS" data-site="2" data-pro="3" data-cache="False" data-name="M&#xE1;y gi&#x1EB7;t LG Inverter 8.5 kg FV1408S4W" data-id="227121" data-price="8840000.0" data-brand="LG" data-cate="M&#xE1;y gi&#x1EB7;t" data-box="BoxHome">
                        <div class="item-label">
                        </div>
                        <div class="item-img">
                            <img data-src="{{ asset($value->Image) }}"   class="lazyload"  data-src="{{ asset($value->Image) }}" alt="{{ $value->Name }}" width=210 height=210>
                        
                        </div>
                        <div class="title-name">
                            <h3>{{ $value->Name }}</h3>
                        </div>
                        
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

                    <a href="javascript:void(0)" class="compare-show" data-id="{{ $value->product_id }}">
                        <i class="fa-solid fa-plus"></i>
                            so sánh
                    </a>
                </div>
                @endif

                @endforeach
                
            </div>
            @endif

            <div class="prd-promo__top clearfix" >
                <a class="readmore-btn" href="{{ route('sale-home') }}"><span>Xem tất cả</span></a>                
            </div>
            
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


                $data = Cache::get('product_search')->whereIn('id', $hot->toArray())->sortByDesc('orders_hot');


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

                <?php 


                ?>

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
                                    
                                    <strong class="price">{{ @number_format($datas->Price , 0, ',', '.')}}&#x20AB;</strong>

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

                             <a href="javascript:void(0)" class="compare-show" data-id="{{ $datas->id }}" data-group="{{ $groups->id }}">
                                <i class="fa-solid fa-plus"></i>
                                    so sánh
                            </a>



                           
                            
                        </div>
                        
                        @endforeach
                    
                    </div>
                    <a class="readmore-txt blue" href="{{ route('details', @$groups->link)  }}"><span>Xem tất cả {{ @$groups->name }}</span></a>
                </div>
            </div>
        </div>

       
        @endif
        @endforeach
        <!-- End  -->

        @if(!empty($bannerscrollRight) && !empty($bannerscrollLeft))
        <!-- Banner dọc 2 bên -->
        <div class="sticky-sidebar">
            <a data-cate="0" data-place="1863" href="{{ $bannerscrollLeft->link }}" class="banner-left"><img style="cursor:pointer" src="{{ asset($bannerscrollLeft->image) }}" alt="Theme Giáng Sinh Trái" width="179" height="271"></a>
            <a data-cate="0" data-place="1864" href="{{ $bannerscrollRight->link }}" class="banner-right"><img style="cursor:pointer" src="{{ asset($bannerscrollRight->image) }}" alt="Theme Giáng Sinh Phải" width="179" height="271"></a>        
        </div>
        @endif
        <?php  
            
            $post = Cache::remember('post_home',10000, function() {
                return App\Models\post::where('active',1)->where('hight_light', 1)->OrderBy('created_at', 'desc')->select('link', 'title', 'image')->limit(7)->get()->toArray();
            }); 

        ?>
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


    @push('script')

    <script type="text/javascript">
         $('.sticky-sidebar').hide();
        $(window).scroll(function (){

            if($(window).scrollTop()>$('.menus-banner').offset().top){

                $('.sticky-sidebar').show();
            }
            else{
                $('.sticky-sidebar').hide();
            }

        })   

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


        $('#banner-sale').owlCarousel({
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
        
    </script>
    @endpush
@endsection      
