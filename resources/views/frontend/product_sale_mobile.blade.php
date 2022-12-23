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