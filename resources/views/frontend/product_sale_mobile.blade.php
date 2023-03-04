
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
        <span> Giảm ngay <strong>{{ $gift_Price  }}</strong> </span>
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
        <span> Quà tặng trị giá {{  $price_gift }} </span>
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