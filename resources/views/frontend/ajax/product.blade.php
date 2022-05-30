
        <div class="row list-pro">
            @if(count($product_search)>0)
            <?php $arr_id_pro = []; ?>
            @foreach($product_search as $value)
            @if($value->active==1)
            <?php   
                $id_product = $value->id;
                array_push($arr_id_pro, $id_product);
                ?>
            <div class="col-md-3 col-6 lists">
                <div class="item  __cate_1942">
                    <a href='/{{ $value->Link }}' data-box="BoxCate" class="main-contain">
                        <div class="item-label">
                            <span class="lb-tragop">Trả góp 0%</span>
                        </div>
                        <div class="item-img item-img_1942">
                            <img class="lazyload thumb" data-src="{{ asset($value->Image) }}" alt="{{ asset($value->Name) }}" style="width:100%"> 
                        </div>
                        <div class="items-title">
                           <!--  <p class='result-label temp1'><img width='20' height='20' class='lazyload' alt='Giảm Sốc' data-src=''><span>Giảm Sốc</span></p> -->
                            <h3 >
                                {{ $value->Name  }}
                            </h3>
                            <div class="item-compare">
                                <span>55 inch</span>
                                <span>4K</span>
                            </div>
                            <!-- <div class="box-p">
                                <p class="price-old black">20.900.000&#x20AB;</p>
                                </div> -->
                            <strong class="price">{{ $value->Price==0?'Liên hệ':number_format(str_replace("\xc2\xa0",'',$value->Price) , 0, ',', '.')}}{{ $value->Price!=0?'đ':''   }}</strong>
                            <!-- <p class="item-gift">Quà <b>1.500.000₫</b></p> -->
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </p>
                                <!--  <p class="item-rating-total">56</p> -->
                            </div>
                        </div>
                    </a>
                    <div class="item-bottom">
                        <a href="#" class="shiping"></a>
                    </div>
                    <!--  <a href="javascript:void(0)" class="item-ss">
                        <i></i>
                        So sánh
                        </a> -->
                </div>
            </div>
            @endif
            @endforeach
            <span class="lists-id">{{ json_encode($arr_id_pro) }}</span>
            @else
            <h2>Không tìm thấy sản phẩm</h2>
            @endif
        </div>
      



