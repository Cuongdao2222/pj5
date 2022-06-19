

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
            #clock{
              user-select:none;
            }
            .glow{
              font-size:10vw;
              font-weight:bold;
              animation:glow 1s ease-in-out infinite alternate;
              -moz-animation:glow 1s ease-in-out infinite alternate;
              -webkit-animation:glow 1s ease-in-out infinite alternate;
            }

            .list-pro h3 {
                 height: 42px;   
             }  

             #deal_list_page .tbl_time tbody td {
                font-size: 15px;
                font-weight: bold;
                color: #0080cb;
                text-align: center;
            } 
            .sale-title{
                text-align: center;
            }
        </style>

    
    @endpush
<section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">
    <div class="sale-title">
        <h1>Sản Phẩm Sale Giá Rẻ</h1>
    </div>

    <div class="container-productbox">

        <?php 

            $product_sale = Cache::remember('sale_products',10, function(){

                // return DB::table('products')->join('sale_product', 'products.id', '=', 'sale_product.product_id')->join('makers', 'products.Maker', '=', 'makers.id')->get();
                 return DB::table('products')->where('active',1)->Orderby('id', 'desc')->take(20)->get();
            });    



           

        ?>

        @if(!empty($product_sale))

        
        <div class="row list-pro">
            
            @foreach($product_sale as $value)

            @if( $value->active ==1)   

                
            <div class="col-md-3 col-6 lists">
                <div class="item  __cate_1942">
                    <a href="{{ route('details', $value->Link) }}" data-box="BoxCate" class="main-contain">
                        <span class="icon_tragop">Trả góp <i>0%</i></span>
                        <div class="item-img item-img_1942">
                            <img class="thumb ls-is-cached lazyloaded" data-src="" alt="{{ $value->Name }}" style="width:100%" src="{{ asset($value->Image) }}"> 
                        </div>
                        <div class="items-title">
                             
                            <h3>
                               {{ $value->Name }}
                            </h3>

                                                                                                                              
                            <strong class="price">{{ @str_replace(',' ,'.', number_format($value->Price))}}&#x20AB;</strong>
                           
                            <div class="item-rating">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>

                            </div>

                        </div>
                        
                    </a>
                    <div class="item-bottom">
                        <a href="#" class="shiping"></a>
                    </div>
                   
                </div>
            </div>

            @endif

        @endforeach
                                                                                        
        </div>

        @endif
       
    </div>


  
    <div class="errorcompare" style="display:none;"></div>
  
    <div class="watched"></div>
    <div class="overlay"></div>

   
   
   
</section>

@endsection