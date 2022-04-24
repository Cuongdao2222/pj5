<?php 

    $page = '404';

   

   
?>

@extends('frontend.layouts.apps')

@section('content') 



 @push('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}"> 

        <link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}"> 
         <link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}"> 

        <style type="text/css">
            
            .box-filter .form-control{
                width: 100%;
            }
            .block-manu{
                width: 150px;
            }
        </style>

    
    @endpush

<section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">

    <div class="container-productbox">


    	<div style="margin-left: 20px;">
            <h2><b>Không tìm thấy link</b></h2>
        </div>
        <hr>

        


        <?php 
            $deal = App\Models\deal::get();

            $now  = Carbon\Carbon::now();

            if(!empty($deal)&count($deal)>0){

                $timeDeal_star = $deal[0]->start;

                $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);

                $timeDeal_end = $deal[0]->end;

                $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);

                $timestamp = $now->diffInSeconds($timeDeal_end);
        
            }


        ?>

        @if(!empty($deal)&count($deal)>0)

        @if($now->between($timeDeal_star, $timeDeal_end))

        @foreach($deal as $value)

        @if( $value->active ==1)

        <h3>Sản phẩm đang có  giá tốt </h3>
        
        <div class="row list-pro">
            
                                                                  
            <div class="col-md-3 col-6 lists">
                <div class="item  __cate_1942">
                    <a href="https://dienmaynguoiviet.net/smat-tivi-lg-55nano80tpa-55-inch-4k" data-box="BoxCate" class="main-contain">
                        <div class="item-label">
                            <span class="lb-tragop">Trả góp 0%</span>
                        </div>
                        <div class="item-img item-img_1942">
                            <img class="thumb ls-is-cached lazyloaded" data-src="" alt="{{ $value->name }}" style="width:100%" src="{{ asset($value->image) }}"> 
                        </div>
                        <div class="items-title">
                             <p class="result-labels"><img class="sale-banner ls-is-cached lazyloaded" alt="Giảm Sốc" data-src="images/css/sale.png" src="https://dienmaynguoiviet.net/images/css/sale.png"></p>
                            <h3>
                               {{ $value->name }}
                            </h3>

                                                                                                                              
                            <strong class="price">{{ @str_replace(',' ,'.', number_format($value->deal_price))}}&#x20AB;</strong>
                           
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </p>

                            </div>

                        </div>
                        
                    </a>
                    <div class="item-bottom">
                        <a href="#" class="shiping"></a>
                    </div>
                 
                </div>
            </div>
                                                                                        
        </div>

        @endif

        @endforeach

        @endif

        @endif
       
    </div>


  
    <div class="errorcompare" style="display:none;"></div>
   <!--  <div class="block__banner banner__topzone">
        <a data-cate="0" data-place="1919" href="https://www.topzone.vn/" onclick="jQuery.ajax({ url: '/bannertracking?bid=48557&r='+ (new Date).getTime(), async: true, cache: false });"><img style="cursor:pointer" src="https://cdn.tgdd.vn/2021/12/banner/Frame4879-1200x120.jpg" alt="Promote Topzone" width="1200" height="120"></a>
    </div> -->
    <div class="watched"></div>
    <div class="overlay"></div>

   
   
</section>

@endsection