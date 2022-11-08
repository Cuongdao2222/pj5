

<?php 

    $now = Carbon\Carbon::now();
?>

<style type="text/css">
    
   
           /* deal*/
           .desc-deal0{
            width: 100% !important;
           }
            .actives-click{
                color: red !important;
            }

           .sale-time-flash{
                margin-bottom: 10px;
           }
           .text-er{
                font-weight: bold;
           }

            .actives{
                background: #fff;
            }

            .titles-time{
               /* border-top: 2px solid #ff9;*/
                margin-top: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
               /* background-color: #fb0707;*/
                margin-bottom: 7px;
                display: block;
                width: 100%;
                height: 80px;
            }

            .titles-time h3 {
                margin: 0;
                display: inline-block;
                color: #000000;
                font-size: 18px;
                text-transform: uppercase;
                padding: 0 13px;
                vertical-align: -3px;
                float: left;
                /*background-color: #ffea26;*/
                padding: 5px 13px;
                border-radius: 4px;
                
                cursor: pointer;
            }


            .titles-time .cat-child {
                padding: 2px 0;
                display: inline-block;
                margin-left: 2px;
            }

            .titles-time .cat-child a {
                line-height: 36px;
                color: #000000;
                background-color: #ff9;
                padding: 11px 10px;
                border-radius: 4px;
            }

            .titles-time .cat-child li {
                float: left;
                padding-right: 8vw;
            }

            .banner-inner {
                height: 50px;
                position: sticky;
                margin: 0 auto;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                line-height: 1.25;
                width: 50%;
                background: #ffc75f;
                border-radius: 10px;
                border: 1px solid;
            }

            .text-promotion {
                font-size: 30px;
                font-weight: bold;
                color: #153464;
                text-transform: uppercase;
            }

            /*.titles-time .minutes{
                font-weight: normal;
                color: #000;
            }*/

        
</style>

<div class="flash-sale" style="height: 305px;">
    
    <span id="banner-flash-sale"><a href="{{ route('dealFe') }}">
    <img width="256" src="{{  asset('images/background-image/Flash_Sale_Theme_256x396.jpg')}}" style="width: auto; height: 300px" alt="banner-fs">
    </a></span>
    <div class="flash-product nk-product-of-flash-sales">
        <div class="col-flash col-flash-2 active">
            <div id="sync1S" class="slider-banner owl-carousel flash-sale-banner">
                @if($deal->count()>0)

               
                @foreach($deal as $key => $value)
               
                @if( !empty($value->active) && $value->active ==1 && $now->between($value->start, $value->end)||$id>0)

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
                                   </div>
                            </div>
                            <div style="margin-top: 11px">
                                <div class="nk-top-stickers"><span class="nk-sticker nk-new">Mới</span></div><div>
                                        <p class="title-shock-price">Giá sốc online</p>
                                        <?php 
                                            if($price ==0){
                                                $price = $value->deal_price;
                                            }
                                        ?>
                                        <span class="price-new"> {{ $keyss==1?@str_replace(',' ,'.', number_format($price)):'xxx.000' }}&#x20AB;</span>
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
                                
                            </div>
                            <div style="width: 100%; height: 1px; background: #ECECEC; margin-top: 8px"></div>
                            
                            </div>
                        </a>
                    </div>
                </div>

                @endif

                @endforeach
                @endif

            </div>
        </div>
    </div>
</div>

