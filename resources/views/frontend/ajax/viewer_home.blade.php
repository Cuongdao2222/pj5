
@if(!empty($product_viewer))
<div class="products py-4">
    <h3 class="mb-4">Sản phẩm Đã xem</h3>
    <div class="row">
        @foreach($product_viewer as  $value)
        
        <?php 
            $check_deal = App\Models\deal::select('deal_price','start', 'end')->where('product_id', $value->id)->where('active', 1)->first();

            if(!empty($check_deal) && !empty(!empty($check_deal->deal_price))){

                $value->Price = $check_deal->deal_price;
            }    
        ?>
        <div class="col-md-3">
            <a href='{{ route('details', $value->Link) }}'>
                <div class="product">
                    <img src="tu-mat-phap.jpg" alt="Tủ mát Pháp" class="img-fluid">
                    <p>{{ @$value->Name }}</p>
                    <span>{{  str_replace(',' ,'.', number_format($value->Price))  }}đ</span>
                </div>
            </a>     
        </div>
        @endforeach
    </div>
</div>
 @endforeach