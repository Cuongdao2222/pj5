

<?php 

    $now = Carbon\Carbon::now();
?>

<div class="row list-pro listpd"> 


    @if($deal->count()>0)

    @foreach($deal as $key => $value)

                    
    <div class="col-md-3 col-6 lists">
        <div class="item  __cate_1942">
            <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain">
                
                <div class="item-img item-img_1942"> <img class="thumb lazyloaded" data-src="{{ asset($value->image) }}" alt="Smart Tivi LG 75UQ8050PSB 75 inch 4K" style="width:auto; height: 184px;" src="{{ asset($value->image) }}" > </div>
                <div class="items-title">
                    <div class="name">
                        
                         <span> {{ $value->name }} </span>
                    </div>

                    <div class="IKgh3U"><div class="qOgYxF"><span>{{ @str_replace(',' ,'.', number_format($value->price)) }}</span><span class="-92Xgq">₫ </span></div></div>
                    <div class="price-sale">
                        <div class="btn-buy-price">

                            
                             <strong class="price">{{ $keyss==1 && $checksoon==0?@str_replace(',' ,'.', number_format($value->deal_price)):'???.000' }}   </strong>
                            
                            <div class="progress">

                                <div class="progress-done" data-done="70">
                                    70%
                                </div>
                            </div>



                        </div>
                        <div class="btn-buys">
                            <button type="button" class="btn btn-danger btn-buy-click">Mua ngay</button>
                        </div>
                        
                    </div>
                    
                   
                </div>
            </a>
            <div class="item-bottom"> <a href="#" class="shiping"></a> </div>


            @if($keyss==1 && $checksoon==0)

            <?php 
                $percent = floor((intval($value->price)- intval($value->deal_price))/intval($value->price));
            ?>
            <div class="_5ICO3M yV54ZD X7gzZ7">
                <div class="_8PundJ"><span class="percent">{{ $percent }}%</span><span class="tSV5KQ">giảm</span></div>
            </div>
            @endif
            <!-- <a href="javascript:void(0)" class="item-ss"> <i></i> So sánh </a> --> 
        </div>
    </div>

    @endforeach

   
   
    
    @endif

</div>