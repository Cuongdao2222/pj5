<?php
function pricesPromotion($price)
        {

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
            return $gift_Price;
        }

    ?>

@if(!empty($product_sale)&&$product_sale->count()>0)

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
                <span> Quà tặng trị giá {{  pricesPromotion($value->Price) }} </span>
                @endif  

             

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