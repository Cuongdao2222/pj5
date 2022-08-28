

<?php 

    $now = Carbon\Carbon::createFromDate('28-8-2022, 11:00');
?>

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
                            <div class="line_break">|</div>
                                <div class="reviewCount">0 đánh giá</div>
                            </div>
                            <div class="container-timeline">
                            <span class="timeline"><span style="width: 2%"></span></span>
                           <!--  <p>Đã bán <span style="color: #EE1E25">2</span> / 100 sản phẩm</p> -->
                        </div>
                        <div style="width: 100%; height: 1px; background: #ECECEC; margin-top: 8px"></div>
                        <!-- <div class="countdown-flash-sale">
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
                        </div> -->
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

