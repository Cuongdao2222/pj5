<div class="gifts-info" style="display: none;" data-text="{{ strlen($value->promotion) }}">
    <a href="{{ route('details', $value->Link) }}" title="{{ $value->Name }}">
        <div class="title">
           {{ $value->Name }}

           <?php 

                $price = !empty($deal_price)?$deal_price:$value->Price;
           ?>
            <div class="product-price">Giá Bán: <span class="price">{{ @str_replace(',' ,'.', number_format($price)) }} đ</span></div>
        </div>
        
    </a>

   
    <div class="content" style="height:auto; !important">
        @if(!empty($value->promotion))
        <div class="gift-title sprites">Thông tin khuyến mại</div>

        <ol>
            {!!  $value->promotion??'' !!}
        </ol>
        @endif
        <div class="gift-title sprites">Đặc điểm nổi bật</div>
        <ol>
            {!!   str_replace(['Xem thêm', 'Đặc điểm nổi bật'], '', $value->Salient_Features)??'' !!}
        </ol>
    </div>
    <div class="content"></div>
</div>