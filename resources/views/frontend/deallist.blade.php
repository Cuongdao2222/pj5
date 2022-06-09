

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
        </style>

    
    @endpush

<section id="categoryPage" class="desktops" data-id="1942" data-name="Tivi" data-template="cate">
     <div id="clock"></div>
    <div class="container-productbox">

        <?php 
            $deal = App\Models\deal::orderBy('order', 'desc')->get();
            $now  = Carbon\Carbon::now();
            if(!empty($deal)&count($deal)>0){
                $timeDeal_star = $deal[0]->start;
                $timeDeal_star =  \Carbon\Carbon::create($timeDeal_star);
                $timeDeal_end = $deal[0]->end;
                $timeDeal_end =  \Carbon\Carbon::create($timeDeal_end);
                $timestamp = $now->diffInSeconds($timeDeal_end);
        
            }
        ?>

        @if(!empty($deal)&count($deal)>0)

        @if($now->between($timeDeal_star, $timeDeal_end))

        <div class="row list-pro">
            
             @foreach($deal as $value)

            @if( $value->active ==1)   

            <?php 
                $product = App\Models\product::find($value->product_id);
                $price_old = $product->Price;
                $percent = ceil((int)$price_old/(int)$value->deal_price);
            ?>                                                     
            <div class="col-md-3 col-6 lists">
                <div class="item  __cate_1942">
                    <a href="{{ route('details', $value->link) }}" data-box="BoxCate" class="main-contain">
                        <span class="icon_tragop">Trả góp <i>0%</i></span>
                        <div class="item-img item-img_1942">
                            <img class="thumb ls-is-cached lazyloaded" data-src="" alt="{{ $value->name }}" style="width:100%" src="{{ asset($product->Image) }}"> 
                        </div>
                        <div class="items-title">
                             
                            <h3>
                               {{ $value->name }}
                            </h3>

                                                                                                                              
                            <strong class="price">{{ @str_replace(',' ,'.', number_format($value->deal_price))}}&#x20AB;</strong>
                           
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
                    <table class="tbl_time" width="100%">
                        <thead>
                            <tr>
                            <td>Tiết kiệm</td>
                            <td>Người đã mua</td>
                            <td>Thời gian còn lại</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr bgcolor="#eee">
                            <td align="center">{{ @$percent }}%</td>
                            <td align="center">0</td>
                            <td align="center"><div  data-time-left="132624" class="clock"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                 
                </div>
            </div>

            @endif

        @endforeach
                                                                                        
        </div>

        

        @endif

        @endif
       
    </div>


  
    <div class="errorcompare" style="display:none;"></div>
  
    <div class="watched"></div>
    <div class="overlay"></div>

    @push('script')

    <script type="text/javascript">

         // đếm thời gian 

         //document.getElementById('svg').innerHTML = xmlSvg;
                                        
        time = '{{ @$timestamp }}';
        number_deal_product =10;
        //in time 
        var h = 12;
        var i = 0;
        var s = 0;
    
        amount = time //calc milliseconds between dates
        days = 0;
        hours = 0;
        mins = 0;
        secs = 0;
        out = "";
    
    
        hours = Math.floor(amount / 3600);
        amount = amount % 3600;
        mins = Math.floor(amount / 60);
        amount = amount % 60;
        secs = Math.floor(amount);
            
            
    
    
        //time run 
        if(parseInt(time)>0 && parseInt(number_deal_product)>0){
         h = hours;
          m = mins;
          s = secs;
        }   
        else{
            let today =  new Date();
            h = 99 - parseInt(today.getHours());
            m = 59 - parseInt(today.getMinutes());
            s = 59 - parseInt(today.getSeconds());
            
        }

        start();    
        function start()
        {

              /*BƯỚC 1: LẤY GIÁ TRỊ BAN ĐẦU*/
              if (h === null)
              {
                  h = parseInt($('.hour').text());

              }

              /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
              // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
              //  - giảm số phút xuống 1 đơn vị
              //  - thiết lập số giây lại 59
              if (s === -1){
                  m -= 1;
                  s = 59;
              }

              // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
              //  - giảm số giờ xuống 1 đơn vị
              //  - thiết lập số phút lại 59
              if (m === -1){
                  h -= 1;
                  m = 59;
              }

              // Nếu số giờ = -1 tức là đã hết giờ, lúc này:
              //  - Dừng chương trình
              //if (h == -1){

                 //clearTimeout(timeout);
                 //$('#timer-391923717').hide();
                  //return false;


              //}



              /*BƯỚC 1: HIỂN THỊ ĐỒNG HỒ*/



              var hour =  h.toString();

              var seconds =  s.toString();

              var minutes =  m.toString();



              // $('.hourss').text(h<10?'0'+hour:''+hour);
              // $('.secondss').text(s<10?'0'+seconds:''+seconds);
              // $('.minutess').text(m<10?'0'+minutes:''+minutes);

            let currentHour = h<10?'0'+hour:''+hour;
            let currentMinutes = m<10?'0'+minutes:''+minutes;
            let currentSeconds = s<10?'0'+seconds:''+seconds;

    
            let currentTimeStr =currentHour + ":" + currentMinutes + ":" + currentSeconds;


            $('.clock').html(currentTimeStr);

              // Insert the time string inside the DOM
              document.getElementById("clock").innerHTML = `<h1>Thời gian còn lại ${currentTimeStr}</h1>`;


              /*BƯỚC 1: GIẢM PHÚT XUỐNG 1 GIÂY VÀ GỌI LẠI SAU 1 GIÂY */
              timeout = setTimeout(function(){
                  s--;
                  start();


              }, 1000);
        }
    </script>
    @endpush
   
   
</section>

@endsection