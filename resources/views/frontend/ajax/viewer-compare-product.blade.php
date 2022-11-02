<style type="text/css">
    
    .check{
        color: red;
    }
   
</style>


@if($product_data->count()>0)
@foreach($product_data as $value)
<li data-id="234997" data-issetup="1" data-productcode="3041094001141" class="productid-234997" >
    <a href="javascript:void(0)" data-s="Nomal" data-site="2" data-pro="3" data-cache="True" data-sv="webdmx-26-125" data-name="{{ $value->Name }}" data-id="234997" data-price="5890000.0" data-brand="Casper" data-cate="Tivi" data-box="BoxCate" class="main-contain">
        <div class="item-label"> 
            <span class="lb-tragop">Trả góp 0%</span> 
        </div>
        <div class="item-img item-img_1942">
            <img class=" thumb" src="{{ asset($value->Image) }}" alt="{{ $value->Name }}">
        </div>
        <h3>
            {{ $value->Name }}
        </h3>
    </a>
    <div class="item-bottom">
        <a href="#" class="shiping"></a>
    </div>


    <a href="javascript:;" class="pro-nrview item-ss active compare-shows" data-id="{{ $value->id }}"> Thêm so sánh</a>
</li>

@endforeach
@endif


<script type="text/javascript">


    
    $('.compare-shows').click(function() {

            id = $(this).attr('data-id');

            data_id = $(this).attr('data-group');

            // kiểm tra đã tick so sánh hay chưa

            if($(this).hasClass('check')){

                alert('sản phẩm này đã được thêm vào so sánh');
            }
            else{
                $('.compare-shows').text('đã thêm so sánh');

                $('.compare-shows').addClass('check');

                if(ar_product.length<3){

                    ar_product.push(id);

                    console.log(ar_product);

                } 
                
            }

           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('compare-show') }}",
                data: {
                    ar_product_id: JSON.stringify(ar_product),
                    data_id:data_id,
                       
                },
                success: function(result){
                   $('#js-compare-holder').html('');
                   $('#js-compare-holder').append(result);
                }
            });         
            
          

            $('.global-compare-group').show();
        });
</script>
