

    @extends('frontend.layouts.apps')

    @section('content') 


    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}?">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=121">
    <link rel="stylesheet" href="{{ asset('css/customs.css') }}?v=245754.75.52928">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&subset=vietnamese" rel="stylesheet">
    
    
    <!-- end header -->
    <!-- begin main -->

     <style type="text/css">

        em{
            font-style: italic;
        }
        .header__top-mobile{
            height: 133px;
        }
        .emtry_content, .emtry_content h2, .emtry_content h3, .emtry_content h4, .emtry_content h5{
            color: #000000 !important;
        } 

        .nd a{
            font-size: revert !important;
        }
        .blog-detail .box-ads .img{
            max-width: 40%;
            margin-right: 2%;
/*            width: 36%;*/
        }

        .detail-buy .info .btn-buy {
            background: -webkit-linear-gradient(top, #f89406, #f76b1c);
            border: 1px solid #d97f00;
            padding: 5px 15px;
            text-align: center;
            color: #fff;
            text-transform: uppercase;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            font-size: 14px;
            font-weight: 300;
            display: block;
            margin-top: 5px;
            width: 135px;
        }

         .listproducts{
            border: 1px solid #ddd;
        }

        .detail-buy .info .price-current {
                display: block;
                overflow: hidden;
                padding: 3px 0;
                font-size: 22px;
                color: #d0021b;
                font-weight: 600;
                margin: 0;
            }

        @media only screen and (max-width: 600px) {

            .nd ul {
                padding-bottom: 20px;

            }    

        }    

        



        @media only screen and (min-width: 600px) {

            .detail-buy {
                width: 710px;
                display: flex !important;
                position: relative;
/*                border: 1px solid #f3f3f3;*/
                padding: 10px 5px;
                margin-bottom: 20px;
            }

            .listproducts img{
                height: 153px;
            }

            .listproducts .price-old {
                color: #666;
                display: inline-block;
                font-size: 14px;
                line-height: 17px;
                text-decoration-line: line-through;
            }

           

            .detail-buy .info h3 {
                color: #333;
                font-weight: 600;
                font-size: 16px;
                overflow: hidden;
                max-width: 290px;
                line-height: 1.5;
                margin: 4px 0;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
                overflow: hidden;
            }

            

            p.prRating {
                padding: 0;
                font-size: 12px;
                display: flex
            ;
                width: 170px;
                align-items: center;
                margin: 0;
                margin-bottom: 7px;
            }

        }    

        

        /*.emtry_content strong{
            font-size: 17px;
        } */

       
    </style>
    <main class="bg-fff">
        <!-- Begin menu blog -->
        <div class="menu_blog">
            <ul class="dm_container">
                <li>
                    <a href="/tu-van-ti-vi/">
                    <img src="{{ asset('images/template/logo/tivi.png') }}" alt="">
                    <span>Tư vấn 
                    <br> tivi</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-tu-lanh/">
                    <img src="{{ asset('images/template/logo/tu-lanh.png') }}" alt="">
                    <span>Tư vấn
                    <br> tủ lạnh</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-may-giat/">
                    <img src="{{ asset('images/template/logo/may-giat.png') }}" alt="">
                    <span> Tư vấn
                    <br> máy giặt</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-dieu-hoa/">
                    <img src="{{ asset('images/template/logo/dieu-hoa.png') }}" alt="">
                    <span>Tư vấn
                    <br> điều hòa</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-gia-dung/">
                    <img src="{{ asset('images/template/logo/gia-dung.png') }}" alt="">
                    <span>Tư vấn
                    <br> gia dụng</span>
                    </a>
                </li>
                <li>
                    <a href="/tu-van-mua-sam/">
                    <img src="{{ asset('images/template/logo/mua-sam.png') }}" alt="">
                    <span>Tư vấn
                    <br> mua sắm</span>
                    </a>
                </li>
                <li>
                    <a href="/meo-vat-gia-dinh/">
                    <img src="{{ asset('images/template/logo/meo-vat.png') }}" alt="">
                    <span>Mẹo vặt
                    <br> gia đình</span>
                    </a>
                </li>
                <li>
                    <a href="/tin-khuyen-mai/">
                    <img src="{{ asset('images/template/logo/khuyen-mai.png') }}" alt="">
                    <span>Tin
                    <br> Khuyến Mại</span>
                    </a>
                </li>
                <li>
                    <a href="">
                    <img src="{{ asset('images/template/logo/video.png') }}" alt="">
                    <span>Video
                    <br>clip</span>
                    </a>
                </li>
            </ul>
        </div>


        <!-- End menu blog -->
        <div class="blog-list dm_container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="sidebar-left">
                        <figure>
                            <img src="" alt="">
                        </figure>
                        <ul class="ulcatemenu">
                            <li class="active"><a>{{  $data->category==5?'':$name_cate}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="main-blog-list">
                        <div style="width:100%; height: 50px;">
                            <h1 class="title">{{  $data->category==5?'':$name_cate}}</h1>
                        </div>
                        
                        <div class="blog-detail">
                            <div class="detail-head">
                                <h1>{{ $data->title }}</h1>
                                <time>{{ $data->created_at->format('d-m-Y, H:i') }}</time>
                                <div id="fb-root" class=" fb_reset">
                                    <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                                        <div></div>
                                    </div>
                                </div>
                              
                               
                            </div>

                          <!--   <div class="box-ads">
                                <ul class="listproducts listproduct-shortcode listproduct-col5 btn-has">
                                    <div class="detail-buy  clearfix">
                                        <div class="img">
                                            <a href="/quat/dung-senko-dh1600?itm_source=knh&amp;itm_medium=shortcode&amp;itm_content=268450" rel="dofollow noopener">
                                                    <label class="no-installment"></label>
                                                <img data-src="https://cdn.tgdd.vn/Products/Images/1992/268450/268450-600x600.jpg" onerror="ImgError(this)" class=" ls-is-cached lazyloaded" alt="Quạt đứng Senko 3 cánh DH1600 47W" src="http://localhost:8000/uploads/product/1663815651_Smart Tivi QLED Samsung QA55Q60B 55 inch 4K (10).jpg">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <h3>Quạt đứng Senko 3 cánh DH1600 47W</h3>
                                                    <p class="price-current">
                                                        610.000₫
                                                    </p>
                                                    <div class="info-price">
                                                        <p class="price-old">700.000₫</p>
                                                        <span class="percent">-12%</span>
                                                    </div>
                                                    <p class="prRating">
                                                        
                                                        
                                                    </p>
                                            <a href="/quat/dung-senko-dh1600?itm_source=knh&amp;itm_medium=shortcode&amp;itm_content=268450" class="btn-buy" target="_blank">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </ul>
                            </div> -->

                            <div class="emtry_content Description nd">
                                <?php 

                                    $content = preg_replace("/<a(.*?)>/", "<a$1 target=\"_blank\">",  $new_content);
                                ?>
                            
                                {!!   $content  !!}
                            </div>
                            <div class="blog-related">
                                <h3>Tin tức liên quan</h3>
                                <ul>
                                    @if(isset($related_news))
                                    @foreach($related_news as $news)
                                    @if($news->id != $data->id)
                                    <li><a href="{{ route('details', $news->link) }}">{{ $news->title }}</a></li>
                                    @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                       <!--  <div class="bloglist-page">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="pagingIntact"><a>Xem trang</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingViewed">1</td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=2">2</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=3">3</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=4">4</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=5">5</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=6">6</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=7">7</a></td>
                                    <td class="pagingSpace"></td>
                                    <td class="pagingFarSide" align="center">...</td>
                                    <td class="pagingIntact"><a href="/tu-van-mua-sam/?page=2">Tiếp theo</a></td>
                                </tr>
                            </table>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="banner-blog">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end main -->
    <!--<hr>-->
    <!-- begin footer -->
    @push('script')
    <script type="text/javascript">
         document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các thẻ img trên trang
            const images = document.querySelectorAll('img');

            // Lặp qua từng ảnh
            images.forEach(function(img) {
                // Kiểm tra xem ảnh có thuộc tính alt không
                if (img.hasAttribute('alt')) {
                    // Lấy giá trị của alt
                    const altText = img.getAttribute('alt');
                    
                    // Sao chép giá trị alt sang title
                    img.setAttribute('title', altText);
                }
            });
        });
    </script>
    <!--  <script type="text/javascript">
        $('img').closest('p').css('text-align', 'center');
        
    </script> -->


    @endpush
   
    @endsection




   
