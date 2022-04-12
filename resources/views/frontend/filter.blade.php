@extends('frontend.layouts.apps')

@section('content') 
    @push('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}"> 

        <style type="text/css">
            

            .item-img_1942{
                height: 290px;
            }
            .breadcrumb{
                padding: 0;
            }
            .list-pro h3{
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                font-size: 14px;
                line-height: 20px;
                overflow: hidden;
                text-overflow: ellipsis;
                margin-bottom: 5px;

            }
            .list-pro h2{
                margin-left:20px ;
            }

            .list-pro .price {
                color: #222;
                display: block;
                font-size: 16px;
                font-weight: bold;
                line-height: 18px;
                margin-bottom: 5px;
            }

            .list-pro .item-compare span{
                border: 1px solid #e0e0e0;
                border-radius: 2px;
                color: #333;
                display: inline-block;
                font-size: 12px;
                line-height: 12px;
                margin-right: 5px;
                padding: 4px 5px;
                white-space: nowrap;
            }
            .list-pro .lists{
                padding: 10px 15px 20px;
                border-bottom: 1px solid #f3f3f3 !important;
                border-right: 1px solid #f3f3f3 !important;
            }
            .list-pro{
                border-left: 1px solid #f1f1f1;
                border-top: 1px solid #f1f1f1;
            }

            .items-title{
                margin: 10px 0 0 10px;
               
            }

            .lists-id{
                display: none;
            }
            @media screen and (max-width: 776px){
                .listproduct{
                    display: block;
                }
                .listproduct .item-img.item-img_1942 {
                    height: auto;
                }
                .listproduct img {
                   
                    width: 100%;
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

        <?php  
            $propery_url = $_GET['property'];

            $propery_url_id = explode(',',$propery_url);
            
        ?>
        
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
        <div class="top-banner">
            <section>
                <div class="slider-bannertop owl-carousel owl-theme">
                    <div class="item">
                        <a aria-label="slide" data-cate="1942" data-place="1537"><img width=800  src="https://cdn.tgdd.vn/2022/01/banner/800-200-800x200-38.png" alt="tivi chung"  ></a>
                    </div>
                    
                </div>
                <!-- <div class="promote-banner ">
                    <a href="/Banner C&#x1ED1; &#x110;&#x1ECB;nh" class="promote-item">
                    <a aria-label="slide" data-cate="1942" data-place="1538" href="#" onclick="jQuery.ajax({ url: '/bannertracking?bid=43621&r='+ (new Date).getTime(), async: true, cache: false });"><img  src="https://cdn.tgdd.vn/2021/07/banner/TraGop390-97-390x97-1.png" alt="Banner Cố Định"  ></a>
                    </a>
                    <a href="/tivi tr&#x1B0;ng b&#xE0;y" class="promote-item">
                    <a aria-label="slide" data-cate="1942" data-place="1538" href="https://www.dienmayxanh.com/may-doi-tra/tivi?type=7#" onclick="jQuery.ajax({ url: '/bannertracking?bid=45610&r='+ (new Date).getTime(), async: true, cache: false });"><img  src="https://cdn.tgdd.vn/2021/08/banner/390-97-390x97-4.png" alt="tivi trưng bày"  ></a>
                    </a>
                </div> -->
            </section>

        </div>
       
 
        <div class="box-filter top-box  block-scroll-main cate-1942">



            <section>
                <div class="jsfix scrolling_inner scroll-right">
                    <div><h4>Điện máy nguời việt là địa chỉ bán tivi chính hãng uy tín tại Hà Nội. Chúng tôi cam kết tất cả sản phẩm đều là hàng chính hãng, nguyên đai, nguyên kiện, mới 100%.</h4></div>
                    <div class="box-filter block-scroll-main scrolling">
                        @if(isset($filter))
                        @foreach($filter as $filters)

                        
                        <?php
                            $propertyId =  App\Models\property::where('filterId', $filters->id)->get();

                        ?>


                        <div class="filter-item block-manu ">
                            <select class="form-control" id="selectfilter{{ $filters->id }}" name="selectfilter" onchange='demo("{{ $filters->id }}")'>
                                <option value="0">{{ $filters->name }}</option>
                                @if(isset($propertyId))
                                @foreach($propertyId as $property)
                                <option value="{{ $property->id}}" {{  in_array($property->id, $propery_url_id)?'selected':'' }}> {{ $property->name}}</option>
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
        <section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">

            
            
            <div class="box-sort ">
                @if(isset($product_search))
                <p class="sort-total"><b>{{ count($product_search) }}</b> Sản phẩm <strong class="manu-sort"></strong></p>

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
                    @if(isset($product_search))
                    <?php $arr_id_pro = []; ?>
                   
                    @foreach($product_search as $value)
                        @if($value->active==1)

                            <?php   

                                $id_product = $value->id;
                                array_push($arr_id_pro, $id_product);
                            ?>

                        <div class="col-md-3 col-6 lists">
                            <div class="item  __cate_1942">
                                <a href='{{ route("details", $value->Link ) }}' data-box="BoxCate" class="main-contain">
                                    <div class="item-label">
                                        <span class="lb-tragop">Trả góp 0%</span>
                                    </div>
                                    <div class="item-img item-img_1942">
                                        <img class="lazyload thumb" data-src="{{ asset($value->Image) }}" alt="{{ asset($value->Name) }}" style="width:100%"> 
                                    </div>
                                    <div class="items-title">
                                        <p class='result-label temp1'><img width='20' height='20' class='lazyload' alt='Giảm Sốc' data-src=''><span>Giảm Sốc</span></p>
                                        <h3 >
                                            {{ $value->Name  }}
                                        </h3>

                                        
                                        <div class="item-compare">
                                            <span>55 inch</span>
                                            <span>4K</span>
                                        </div>
                                        <!-- <div class="box-p">
                                            <p class="price-old black">20.900.000&#x20AB;</p>
                                        </div> -->
                                        
                                        <strong class="price">{{ number_format($value->Price , 0, ',', '.')}}</strong>
                                        <!-- <p class="item-gift">Quà <b>1.500.000₫</b></p> -->
                                        <div class="item-rating">
                                            <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </p>
                                           <!--  <p class="item-rating-total">56</p> -->
                                        </div>

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
                        @endif
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

           
           
        </section>

        <?php  
            $propery_url = $_GET['property'];

            // $propery_url_id = explode(',',$propery_url);

            
        ?>

       
        @push('script')
        <script type="text/javascript">
            function demo(filters) {

                filers_url = "{{ $_GET['filter'] }}";

                filers_url = filers_url.split(',');

                var propertys =    "{{ $_GET['property'] }}";
                propertys = propertys.split(',');

                property = $('#selectfilter'+filters).val();
            
                //Xóa phần tử giống nhau trong mảng
                if(property !=0){
                    
                    if(filers_url.indexOf(filters)>-1){

                        filers_url.splice(filers_url.indexOf(filters));

                        propertys.splice(filers_url.indexOf(filters));

                    }

                    filers_url.push(filters);
                        
                    propertys.push(property);

                }
    
                if(filers_url.length>0){
                    propertys = propertys.join(',');

                    filter = filers_url.join(',');

                    href  = 'http://localhost/ti-vi/?filter='+filter+'&group_id={{ @$id_cate }}&property='+propertys+'&link={{ $link }}';

                    window.location.href  = 'http://localhost/ti-vi/?filter='+filter+'&group_id={{ @$id_cate }}&property='+propertys+'&link={{ $link }}';
                }


             }


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

                    filter = JSON.stringify(filter);

                    propertys = JSON.stringify(propertys);

                    window.location.href = '{{ route('details',$link) }}?filter=,'+filter+'&group_id={{ @$id_cate }}&property='+propertys+'&link={{ $link }}';

                }

            }

            $( "#sort-by-option" ).bind( "change", function() {

                $.ajax({
       
                type: 'GET',
                    url: "{{ route('filter-option') }}",
                    data: {
                        json_id_product: $('.lists-id').text(),
                        action:$(this).val(),
                        
                    },
                    success: function(result){

                        $('#categoryPage').html('');

                        $('#categoryPage').html(result);

                        console.log(json_id_product)

                    }
                });

            });

        
        </script>
        @endpush
@endsection 

        