@extends('frontend.layouts.apps')

@section('content') 
    @push('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}?ver=1"> 

        <link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}?ver=1"> 
         <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=1"> 
         <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=1"> 

        <style type="text/css">
            
            .box-filter .form-control{
                width: 100%;
            }
            .block-manu{
                width: 150px;
            }
            .option-gift{
                display: flex;
            }
            .option-href{
                display: none;
            }
            

            @media screen and (max-width:776px) {

                .option-href{
                    display: block;
                }

                .box-filter{
                    display: flex;
                    overflow: auto;

                }
                .box-filter .form-control {
                    width: 117px;
                }
            }
        </style>

    
    @endpush

   

        <div class="locationbox__overlay"></div>
        <!-- <div class="locationbox">
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
        </div> -->
        <!-- <div class="locationbox__popup new-popup hide" id="lc_pop--sugg">
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
 -->
        @if(empty($page_search))
        <div class="bsc-block">
            <section>
                <ul class="breadcrumb">
                    <li><a href="{{ route('homeFe') }}">Trang chủ</a></li>

                    @if(isset($ar_list))
                    @foreach($ar_list as $val)
                    <li>
                        <a href="{{ route('details', @$val['link']) }}">{{ @$val['name'] }}</a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </section>
        </div>

        <?php 

            $banner = cache()->remember('banner_group_4', 1000, function () {

                $banner = App\Models\banners::where('option', 4)->get()->last()??'';

                return $banner;
                
            });
            
        ?>
        <div class="top-banner">
            <section>
                <div class="slider-bannertop owl-carousel owl-theme">

                    @if(!empty($banner)&& $banner->active ==1)
                     <div class="item">
                        <a aria-label="slide" data-cate="1942" data-place="1537"><img width=1200  src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"  ></a>
                    </div>
                    @endif
                   
                    
                </div>
               
            </section>

        </div>
       
 
        <div class="box-filter top-box  block-scroll-main cate-1942">


            <section>
                <div class="jsfix scrolling_inner scroll-right">
                    <div><h4>{!! @$slogan !!}</h4></div>
                    <div class="box-filter block-scroll-main scrolling">
                        @if(isset($filter))
                        @foreach($filter as $filters)

                        
                        <?php

                            $propertyId = cache()->remember('filterId_'.$filters->id, 1000, function () use($filters){

                                $propertyId =  App\Models\property::where('filterId', $filters->id)->get()??'';
                                return $propertyId;
                            });
                           
                        ?>

                        <div class="filter-item block-manu ">
                            <select class="form-control" id="selectfilter{{ $filters->id }}" name="selectfilter" onchange='mySelectHandler("{{ $filters->id }}")'>
                                <option value="0">{{ $filters->name }}</option>
                                @if(isset($propertyId))
                                @foreach($propertyId as $property)
                                <option value="{{ $property->id}}"> {{ $property->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        
                        @endforeach
                        @endif
                    </div>    
                </div>       
            </section>
        </div>
        @endif



        @if(!empty($parent_id_cate)&&$parent_id_cate==8)

        <select class="option-href" style="width: 35%;">
            <option value="https://dienmaynguoiviet.vn/gia-dung" {{ $id_cate==8?'selected':'' }} >Tất cả sản phẩm</option>
            <option value="https://dienmaynguoiviet.vn/may-hut-bui" {{ $id_cate==101?'selected':'' }}>Máy hút bụi</option>
            <option value="https://dienmaynguoiviet.vn/binh-nong-lanh" {{ $id_cate==102?'selected':'' }}>Bình nước nóng</option>
            <option value="https://dienmaynguoiviet.vn/ban-la" {{ $id_cate==103?'selected':'' }}>Bàn là</option>
            <option value="https://dienmaynguoiviet.vn/may-say-toc" {{ $id_cate==104?'selected':'' }}>Máy sấy tóc</option>
             <option value="https://dienmaynguoiviet.vn/may-loc-khong-khi" {{ $id_cate==317?'selected':'' }}>Máy lọc không khí</option>
            <option value="https://dienmaynguoiviet.vn/may-loc-khong-khi-samsung" {{ $id_cate==105?'selected':'' }}>Máy lọc không khí Samsung</option>
            <option value="https://dienmaynguoiviet.vn/may-loc-khong-khi-sharp" {{ $id_cate==106?'selected':'' }}>Máy lọc không khí Sharp</option>
            <option value="https://dienmaynguoiviet.vn/noi-com-dien" {{ $id_cate===108?'selected':'' }}>Nồi cơm điện</option>
            <option value="https://dienmaynguoiviet.vn/lo-vi-song" {{ $id_cate==109?'selected':'' }}>Lò vi sóng</option>
            <option value="https://dienmaynguoiviet.vn/binh-thuy-dien" {{ $id_cate==110?'selected':'' }}>Bình thủy điện</option>
            <option value="https://dienmaynguoiviet.vn/am-sieu-toc" {{ $id_cate==111?'selected':'' }}>Ấm siêu tốc</option>
            <option value="https://dienmaynguoiviet.vn/may-xay-sinh-to" {{ $id_cate==112?'selected':'' }}>Máy xay sinh tố</option>
            <option value="https://dienmaynguoiviet.vn/may-ep-hoa-qua" {{ $id_cate==113?'selected':'' }}>Máy ép hoa quả</option>
            <option value="https://dienmaynguoiviet.vn/may-xay-da-nang">Máy xay đa năng</option>
        </select>

    
        @endif

        <section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">
            <div class="box-sort ">
                @if(isset($data))
                <p class="sort-total"><b>{{ $numberdata }}</b> Sản phẩm <strong class="manu-sort"></strong></p>

                @endif
                <div class="sort-select ">
                    <label for="standard-select">Xếp theo</label>
                    <div class="select">
                      <select id="sort-by-option">
                        <option value="id">Nổi bật</option>
                        <option value="asc">Giá tăng dần</option>
                        <option value="desc">Giá giảm dần</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="container-productbox">
                <!-- <div id="preloader">
                    <div id="loader"></div>
                </div> -->
                <div class="row list-pro">
                   
                    @if(isset($data))
                    <?php $arr_id_pro = []; ?>
                   
                    @foreach($data as $value)
                        
                            <?php   

                                $id_product = $value->id;
                                array_push($arr_id_pro, $id_product);

                                $check_deal = cache()->remember('check_deal_'.$value->id, 1000, function () use($value){

                                    $check_deal = App\Models\deal::select('deal_price','start', 'end')->where('product_id', $value->id)->where('active', 1)->first()??'';

                                    return $check_deal;
                                });

                                

                                $deal_check_add = false;

                                $now  = Carbon\Carbon::now();
                                
                                if(!empty($check_deal) && !empty(!empty($check_deal->deal_price))){
                                     
                                    $timeDeal_star = $check_deal->start;
                                    $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
                                    $timeDeal_end = $check_deal->end;
                                    $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
                                    $timestamp = $now->diffInSeconds($timeDeal_end);

                                    if($now->between($check_deal->start, $check_deal->end)){
                                       
                                        $value->Price = $check_deal->deal_price;
                                        
                                    }
                                
                                }
                                else{

                                    // check flash deal
                                   

                                    $date_string_flash_deal = cache()->remember('date_flash_deal', 1000, function () {

                                        $date_string_flash_deal = DB::table('date_flash_deal')->where('id', 1)->first()->date??'';

                                        return $date_string_flash_deal;
                                    });

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


                                        foreach($define as $key => $values)

                                        if($now->between($values['startTime'], $values['endTime'])){
                                            
                                            $groups_deal = $key;

                                            $groups_deal = $groups_deal+1;

                                            $flashDeal = App\Models\flashdeal::where('product_id', $id_product)->where('flash_deal_time_id', $groups_deal)->where('active',1)->first();



                                            if(!empty($flashDeal)){

                                                $price_flash_deal = DB::table('flash_deal')->where('id', $flashDeal->flash_deal_id)->first();

                                                $value->Price = $price_flash_deal->price;
                                               
                                            
                                            }

                                        }
                                    }
                                
                                }
                            ?>

                           

                        <div class="col-md-3 col-6 lists">
                            <div class="item  __cate_1942">
                                <a href='{{ route("details", $value->Link ) }}' data-box="BoxCate" class="main-contain">
                                    @if($value->Price>=3000000)
                                    <span class="icon_tragop">Trả góp <i>0%</i></span>
                                    @endif
                                    <div class="item-img item-img_1942">
                                        <img class="lazyload thumb" data-src="{{ asset($value->Image) }}" alt="{{ $value->Name }}" style="width:100%"> 
                                    </div>
                                    <div class="items-title">
                                        
                                        <h3 >
                                            {{ $value->Name  }}
                                        </h3>

                                        @if(!empty($id_cate) && $id_cate<5)
                                        <?php
                                            
                                                if($id_cate == 1){
                                                    $searchstring = 'inch';
                                                }
                                                else{
                                                    $searchstring = 'inverter';
                                                }
                                               
                                            $infoName  = str_replace($value->ProductSku,'', strstr($value->Name, $value->ProductSku));

                                            $infoName = str_replace($value->ProductSku,'', $infoName);

                                            if(!empty($infoName)){
                                                $arNames = [];
                                                if(strpos($value->Name, $searchstring)){

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
                                      
                                        <?php 

                                            if($value->Price =='Liên hệ'){
                                                $value->Price = 0;
                                            }

                                        ?>
                                        
                                        <strong class="price">{{ $value->Price==0?'Liên hệ':number_format(str_replace("\xc2\xa0",'',$value->Price) , 0, ',', '.')}}{{ $value->Price!=0?'đ':''   }}</strong>
                                        <!-- <p class="item-gift">Quà <b>1.500.000₫</b></p> -->
                                        <div class="item-rating">
                                            <p>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                               
                                            </p>
                                           <!--  <p class="item-rating-total">56</p> -->
                                        </div>

                                        <?php
                                            // check quà phần tìm kiếm sản phẩm
                                            if(empty($id_cate)){

                                                $groupProduct = App\Models\groupProduct::select('name', 'link', 'product_id','id')->where('level', 0)->get();

                                                foreach($groupProduct as $groupProducts ){

                                                    if(!empty(json_decode($groupProducts->product_id))){

                                                        if(in_array($value->id,json_decode($groupProducts->product_id))){

                                                           

                                                            $id_cate =  $groupProducts->id;

                                                            
                                                        }
                                                    }
                                                }

                                              

                                            }


                                            $gift = gift($id_product);

                                            if(!empty($id_cate)){
                                                if(empty($gift)){
                                                    $gift = groupGift($id_cate);
                                                    
                                                    if(empty($gift)){

                                                        $gift =[];
                                                    }
                                                }
                                            } 

                                        ?>
                                        
                                       
                                        @if(!empty($gift)&&!$check_deal)

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
                                           
                                        @endif

                                    </div>
                                    
                                </a>
                                <div class="item-bottom">
                                    <a href="#" class="shiping"></a>
                                </div>
                               <!--  <a href="javascript:void(0)" class="item-ss">
                                    <i></i>
                                    So sánh
                                </a> -->
                            </div>
                        </div>
                       
                    @endforeach


                     <span class="lists-id">{{ json_encode($arr_id_pro) }}</span>
                      
                   
                   @else   

                    <div style="margin-left: 20px;">
                        <h2>Không tìm thấy sản phẩm</h2>
                    </div>
                    
                    @endif


                </div>
                <!-- <div class="view-more ">
                    <a href="javascript:;">Xem thêm <span class="remain">133</span> Tivi</a>
                </div> -->
            </div>


          
            <div class="errorcompare" style="display:none;"></div>
           <!--  <div class="block__banner banner__topzone">
                <a data-cate="0" data-place="1919" href="https://www.topzone.vn/" onclick="jQuery.ajax({ url: '/bannertracking?bid=48557&r='+ (new Date).getTime(), async: true, cache: false });"><img style="cursor:pointer" src="https://cdn.tgdd.vn/2021/12/banner/Frame4879-1200x120.jpg" alt="Promote Topzone" width="1200" height="120"></a>
            </div> -->
            <div class="watched"></div>
            <div class="overlay"></div>

           
            @if(\Request::route()->getName()!='search-product-frontend' && !empty($data))

            {{ @$data->links() }}

            @endif
        </section>

       

        @push('script')
        <script type="text/javascript">
            filter = [];

            propertys = [];

             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            
            function mySelectHandler(filters){

                property = $('#selectfilter'+filters).val();


                // kiểm tra filter có bị trùng không xóa filter trước + xóa property cùng filter

                if(filter.indexOf(filters)>-1){
                    filter.splice(filter.indexOf(filters),1);
                    propertys.splice(filter.indexOf(filters),1);
                }

                //chỉ lấy giá trị 
                if(property !=0){

                    filter.push(filters);

                    propertys.push(property);

                }
                
                // var filterss['code'] = property; 


                // khi người dùng select option thì gọi hàm
                if(filter.length>0){

                    filter = filter.join(',');

                    propertys = propertys.join(',');
                    
                    @if(!empty($link))


                       
                      
                            window.location.href = '{{ route('details',$link) }}?filter=,'+filter+'&group_id={{ @$id_cate  }}&property=,'+propertys+'&link={{$link  }}';
                            
                    @endif

                }

            }

            $( "#sort-by-option" ).bind( "change", function() {
                

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
       
                type: 'POST',
                    url: "{{ route('filter-option') }}",
                    data: {
                        json_id_product: $('.lists-id').text(),
                        action:$(this).val(),
                        idcate: '{{ $id_cate??'' }}'
                        
                    },
                    success: function(result){

                        $('.container-productbox').html('');

                        $('.container-productbox').html(result);

                    

                    }
                });

            });

             $('.option-href').on('change', function(){
               window.location = $(this).val();
            });

        
        </script>
        @endpush
@endsection 

        