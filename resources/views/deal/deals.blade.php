@extends('layouts.app')

@section('content')



<style type="text/css">
:root{--accent:#2aa493;--muted:#7a7a7a;--bg:#f8fafb;--card:#ffffff}
body{margin-top:20px;font-family:Inter, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:var(--bg);color:#222}
.main-box{background:var(--card);border-radius:10px;padding:18px;box-shadow:0 6px 18px rgba(27,40,50,0.06)}

/* Buttons */
.btn-primary{background:var(--accent);border-color:var(--accent);color:#fff;padding:8px 12px;border-radius:6px;cursor:pointer}
.btn-default{background:#fff;border:1px solid #ddd;color:#333;padding:8px 12px;border-radius:6px;cursor:pointer}
.btn-primary:hover{opacity:0.95}

/* Deal table overall */
#tb_padding, .tb-padding{width:100%;border-collapse:collapse;font-size:14px}
#tb_padding thead th, .tb-padding thead th{background:#fbfdfe;color:#263238;padding:12px;text-align:left;border-bottom:2px solid #eef3f4}
#tb_padding td, #tb_padding th, .tb-padding td{Padding:12px;border-bottom:1px solid #eef3f4;vertical-align:middle}

/* Product row styling */
#tb_padding tr{background:transparent}
#tb_padding tr:hover{background:linear-gradient(90deg,#fbfbfb,#f3f8f8)}

/* Image column */
#tb_padding td img{max-width:110px;border-radius:6px;box-shadow:0 2px 6px rgba(34,34,34,0.06)}

/* Product info */
.product-name{font-weight:700;color:#183643;margin-bottom:6px;display:block}
.product-meta{color:var(--muted);font-size:13px}
.price-deal{color:#d32f2f;font-weight:700}
.price-normal{color:#2e7d32;font-weight:600}

/* Controls and small UI */
.table-actions a{color:var(--accent);text-decoration:none;margin-right:8px}
.table-actions a.danger{color:#e53935}

/* Small inputs inside table */
input[type="text"]{padding:6px 8px;border:1px solid #e6ecec;border-radius:6px}

/* Responsive adjustments */
@media (max-width:900px){
    #tb_padding td:nth-child(3){display:block}
    #tb_padding td img{max-width:80px}
    #tb_padding thead{display:none}
    #tb_padding tr{display:block;margin-bottom:10px;border-radius:8px;background:var(--card);box-shadow:0 4px 12px rgba(18,20,22,0.03);padding:12px}
    #tb_padding td{display:flex;justify-content:space-between;padding:8px;border-bottom:0}
}

.modal-dialog{max-width:840px!important}
</style>

<style>
    .container-fix{
        max-width: 1340px!important;
    }
</style>

<script>

    $(document).ready(function() {
         $("#date-picker1" ).datepicker({ dateFormat: 'dd-mm-yy'});
         $("#date-picker2" ).datepicker({ dateFormat: 'dd-mm-yy'});
         $("#date-picker3" ).datepicker({ dateFormat: 'dd-mm-yy'});
         $("#date-picker4" ).datepicker({ dateFormat: 'dd-mm-yy'});
    }); 
 
  </script>


<div class="container container-fix">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">

                <br>
                <div class="table-responsive">

                    <div>
                        
                        <div class="btn btn-primary add-product">Thêm sản phẩm</div>

                        <div class="btn btn-default accepts">Xác nhận</div>
                    </div>

                    <br>

                    <table class="tb-padding" cellpadding="5" border="1" bordercolor="#CCCCCC">
                        <tbody>
                            <?php  

                                $deal = App\Models\deal::get();

                            ?>

                           <?php 
                                if(!empty($deal) && count($deal)>0){
                           ?> 
                            
                          <tr>
                              <td>Cài đặt thời gian</td>
                              <td>

                               <?php 


                                function get_times ($default = '19:00', $interval = '+30 minutes') {

                                    $output = '';

                                    $current = strtotime('00:00');
                                    $end = strtotime('23:59');

                                    while ($current <= $end) {
                                        $time = date('H:i', $current);
                                        $sel = ($time == $default) ? ' selected' : '';

                                        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) .'</option>';
                                        $current = strtotime($interval, $current);
                                    }

                                    return $output;
                                }

                                ?>

                                
                                  Bắt đầu : <input type="text" id="date-picker1" value="{{  str_replace(strstr($deal[0]->start, ','), '', $deal[0]->start) }}">

                                  <?php  

                                    $end_old_show = DB::table('deal_time')->get()->last();



                                    $start = str_replace(',','',strstr($deal[0]->start, ','));

                                    $end    =    str_replace(',','',strstr($end_old_show->end, ','));




                                  ?>

                                   Giờ: 
                                  <select name="time" id="hours1"><?php echo get_times($default = $start, '+30 minutes'); ?></select>
                                  <br>
                                  <br>
                                  Kết thúc : <input type="text"  id="date-picker2" value="{{ str_replace(strstr($end_old_show->end, ','), '', $end_old_show->end) }}"> 

                                  Giờ: 
                                  
                                  <select name="time" id="hours2">
                                      <?php echo get_times($default = trim($end), '+30 minutes'); ?>
                                  </select>
                              </td>
                          </tr>

                            <?php  

                                }
                            ?>
                      </tbody>
                    </table>

                    <br>
                    
                    <table id="tb_padding" border="1" bordercolor="#CCCCCC" style="width:100%">
                        <tbody>
                            <tr style="background-color:#EEE; font-weight:bold;">
                                <td width="30px">STT</td>
                                <td width="120px">Ảnh Sản phẩm</td>
                                <td>Thông tin</td>
                                <td>Model</td>
                                <td>Tình trạng</td>
                                <td>Quản lý</td>
                                <td>Tồn kho</td>
                                <td>Tồn theo số lượng</td>
                                <td>Sửa giá deal nhanh</td>
                                <td>Sắp xếp</td>
                                <td>Cài thời gian riêng</td>
                            </tr>

                            <?php  
                                $now = Carbon\Carbon::now();

                                $products = DB::table('deal')->OrderBy('id', 'desc')->distinct()->get()->toArray();

                                

                                $product_id_deal = array_map(function($item) {
                                    return $item->product_id;
                                }, $products);

                                $k =0;

                                
                            ?>
                            @isset($products)
                            @foreach($products as $val)
                            <?php  
                                $k++ ;

                               
                            ?>
                            <tr id="row_1208">
                                <td>{{ $k }}</td>

                                <?php 
                                    $product_info = App\Models\product::find($val->product_id);
                                ?>
                                <td align="center">
                                    <img src="{{ asset($product_info->Image) }}" width="100" alt="{{ $val->name }}">
                                    <!--<div><a style="color:green" href="javascript:;" onclick="delete_special(1208)">Xóa bỏ</a></div>-->
                                </td>


                                <td>
                                    <div><a href="{{ route('details', $val->link) }}" target="_blank"><b>{{ $val->name }}</b></a></div>
                                    <div>Giá deal : <b style="color:red;">{{  str_replace(',' ,'.', number_format(intval($val->deal_price)))   }}</b> vnd - Giá thường: <b style="color:red;">{{  str_replace(',' ,'.', number_format(intval($product_info->Price)))   }}</b> </div>
                                    <div>Số lượng : <b style="color:red;">0</b> - Số tối thiểu cho 1 đơn hàng: <b style="color:red;">0</b></div>
                                    <div>Thời gian : Từ <b style="color:red;">{{ @$val->start }}</b> đến <b style="color:red;">{{ $val->end }}</b> 
                                        ({{ $now->between($val->start, $val->end)?'Đang bắt đầu':'chưa bắt đầu'}})
                                    </div>
                                   
                                </td>

                                <td>{{ $product_info->ProductSku }}</td>
                                <td>
                                    <div>Số đơn hàng : <b style="color:red;">0</b></div>
                                    <div>Số Sản phẩm đặt mua: <b style="color:red;">0</b></div>
                                    <div>Lượt xem: <b style="color:red;">0</b></div>
                                </td>


                                <td>
                                    <!-- <div><a href="javascript:void(0)" onclick="update_product({{ $val->id }})">Sửa lại</a></div> -->
                                    <div id="is_feature_{{ $val->product_id }}">
                                        <span><a href="javascript:set_feature('{{  $val->id }}','{{ $val->active }}')">{!! $val->active==0?'<b style="color:green;">Hiển thị</b>':'<b style="color:red">Hạ xuống</b>' !!}</a></span>
                                    </div>
                                    <div><a href="javascript:;" onclick="delete_deal('{{ $val->id }}')">xóa</a></div>
                                </td>

                                <td>
                                    @if( intval($product_info->Quantily)>0)
                                    <b style="color:green">Còn hàng</b>

                                    @else
                                    <b style="color:red">Hết hàng</b>
                                    @endif
                                </td>

                                <td>{{ @$product_info->Quantily  }}</td>


                                <td>
                                    <div>
                                        <input type="text" name="order" value="{{ $val->deal_price }}" class="edit_price_deal{{ $val->id }}">
                                    </div>
                                    
                                    <br>
                                    <div class="btn-primary edit_price_deals{{$val->id}}" style="width: 25%;" onclick="edit_price_deal({{ $val->id }})" >sửa</div>
                                </td>
                                <td>
                                    <div>
                                        <input type="text" name="order" value="{{ $val->order }}" class="edit_order{{ $val->id }}">
                                    </div>
                                    
                                    <br>
                                    <div class="btn-primary edit_orders{{$val->id}}" style="width: 25%;" onclick="update_order({{ $val->id }})" >sửa</div>
                                </td>
                                <td>

                                    <?php 

                                        $timeup = $now->diffInSeconds($val->end); 
                                        $hour  = $timeup/3600;
                                        $timeup = $timeup%3600;
                                        $minutes = $timeup/60;

                                    ?> 

                                    @if($now->between($val->start, $val->end))
                                    Còn {{ floor($hour) }} giờ {{ (int)$minutes }} phút nữa 
                                    
                                    @else
                                        <?php 

                                            // update lại active khi sản phẩm hết thời gian chạy

                                            $z =0;

                                            if($val->active==1){

                                                $z++;

                                                $update = DB::table('deal')->where('id', $val->id)->update(['active'=>0]);

                                                if($z===1){

                                                    Cache::forget('deals');
                                                    $deal = App\Models\deal::get();

                                                    Cache::forever('deals',$deal);

                                                }

                                            }

                                           
                                        ?>

                                        Hết thời gian deal                             
                                     @endif
                                    <br>
                                    <a href="javascript:void(0)" onclick="setTimeDeal({{ $val->id }})">Sửa</a>
                                </td>

                            </tr>
                            @endforeach

                            @endisset
                           
                        </tbody>
                    </table>
                    <br>
                    
                </div>
                
            </div>

        </div>

        <div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chọn sản phẩm</h5>

                        <?php  
                       
                            $option = App\Models\groupProduct::select('id', 'name')->where('parent_id', 0)->get();
                        ?>

                        <select name="group_product_id" id="group_product_id">
                            @foreach($option as $val)
                            <option value="{{$val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                         <h5 class="modal-title" id="exampleModalLabel">tìm kiếm theo tên hoặc model</h5>

                         <input type="text" name="" id="name_product">
                         &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                         <div class="btn-primary accept-find">xác nhận</div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php  


                        ?>
                        <table id="tb-list" border="1" bordercolor="#CCCCCC">
                            <tbody>
                                <tr bgcolor="#EEEEEE" style="font-weight:bold;">
                                    <td style="width:30px">STT</td>
                                    <td>Sản phẩm </td>
                                    <td style="width:150px">Giá bán</td>
                                    <td style="width:150px">Giá Deal</td>
                                    <td style="width:70px">Số lượng</td>
                                    <td style="width:80px">Bảo hành</td>
                                    <td style="width:80px">Chọn</td>
                                </tr>

                                <?php  
                                    $products = App\Models\product::select('Name', 'Link', 'Price','id', 'Link')->where('group_id', 1)->where('active', 1)->Orderby('id', 'desc')->paginate(10);

                                ?>
                               <?php  

                                    $i = 0
                                ?>
                                @if(isset($products))

                                @foreach($products as $val)

                                <?php 

                                    $i++;
                                ?>

                                <tr id="row_{{$val->id}}" class="row-hover">
                                    <td>{{ $i }}</td>
                                    <td>
                                        <b><a href="{{ route('details', $val->Link) }}" class="pop-up">{{ $val->Name }}</a></b> <br>
                                       
                                        <input type="hidden" id="pro_name_{{ $val->id }}" value="{{ $val->id }}">
                                    </td>
                                    <td class="price">
                                        {{ number_format($val->Price , 0, ',', '.')}}  
                                    </td>

                                    <td class="deal-price">
                                        
                                    </td>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        24 Tháng
                                    </td>
                                    <td>
                                        <input type="button" value="Chọn sản phẩm" class="update-bt-all" onclick="selectProduct('{{$val->id}}')"><span id="update_bt_5814"></span>
                                    </td>
                                </tr>

                                @endforeach
                                @endif
                                
                               
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-view">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="select-price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Giá deal cho sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="price-deal" id="price-deal" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-deal-price">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSetTimeDeal" tabindex="-1" role="dialog" aria-labelledby="modalSetTimeDeal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cài đặt thời gian cho sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         Bắt đầu : <input type="text" id="date-picker3" value="{{  str_replace(strstr($deal[0]->start, ','), '', $deal[0]->start) }}">

                          <?php  

                            $start = str_replace(',','',strstr($deal[0]->start, ','));

                            $end    = str_replace(',','',strstr($deal[0]->end, ','));
                          ?>

                           Giờ: 
                          <select name="time" id="hours3"><?php echo get_times($default = $start, '+30 minutes'); ?></select>
                          <br>
                          <br>
                          Kết thúc : <input type="text"  id="date-picker4" value="{{ str_replace(strstr($deal[0]->end, ','), '', $deal[0]->end) }}"> Giờ: 
                          <select name="time" id="hours4">
                              <?php echo get_times($default = $end, '+30 minutes'); ?>
                          </select>   

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary accepts-time-deal" onclick="">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<input type="hidden" name="edit-deal" id="edit-deal">
<input type="hidden" name="time-deal" id="time-deal">

<input type="hidden" name="row" id="row_id">
<script type="text/javascript">


$('.add-product').click(function(){
    $('#modal-product').modal('show');

})

$('.update-bt-all').click(function(){


    $('#select-price').modal('show');

})

 function numberWithCommas(x) {

     x = x.toString().replace('.','');
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function selectProduct(id){

    const product_deal_id = '{{ implode(",", $product_id_deal) }}'.split(',').map(Number);

    <?php
        $allProductSkus = App\Models\product::select('id','ProductSku')->get();

        $dealProductSkus = [];
        if(isset($products) && count($products) > 0){
            foreach($products as $p){
                $prod = App\Models\product::find($p->product_id);
                if($prod && $prod->ProductSku != null){
                    $dealProductSkus[] = $prod->ProductSku;
                }
            }
        }
    ?>

    var productSkuMap = {
    @foreach($allProductSkus as $ap)
    '{{ $ap->id }}':'{{ addslashes($ap->ProductSku) }}',
    @endforeach
    };

    var productModelsInDeal = [
    @foreach($dealProductSkus as $sku)
    '{{ addslashes($sku) }}',
    @endforeach
    ];

    var sku = productSkuMap[id] ? productSkuMap[id].toString() : '';
    if(sku && productModelsInDeal.includes(sku)){
        alert('Model đã tồn tại trong deal, không thể thêm');
        return;
    }

    if (product_deal_id.includes(Number(id))) {

        alert('sản phẩm này đã có trong deal, vui lòng xem lại nhé');

    } else {
        if( $('#row_'+id+' .update-bt-all').val()=='sản phẩm đã được chọn'){
            alert('bạn đã chọn sản phẩm này rồi');

        }
        else{
            $('#select-price').modal('show');
            $('#row_id').val(id)
        }
    }


}

function setTimeDeal(id) {

    $.ajax({

        type: 'GET',
        url: "{{ route('getTimeDeal') }}",
        data: {
            product_id:id,
            
        },
        success: function(result){

            console.log(result);
            start = result[0];
            end   = result[1];
           
            ar_start = start.split(',');
            start_date = ar_start[0];
            start_time = ar_start[1];

            ar_end = end.split(',');
            end_date = ar_end[0];
            end_time = ar_end[1];

            $('#date-picker3').val(start_date);

            // $('#hours3 option:selected').remove();

            $("#hours3 option[value='"+start_time+"']").prop('selected', true);


            $('#date-picker4').val(end_date);


            $("#hours4 option[value='"+end_time+"']").prop('selected', true);

            $('#time-deal').val(id);

        }
    });

    $('#modalSetTimeDeal').modal('show');
}


function update_product(id){


    $('#modal-product').modal('show');

    $('.add-view').addClass('edit');

    $('#modal-product .modal-body').hide();

    $('#edit-deal').val(id);
}
function edit_price_deal(id){
    
    let val = $('.edit_price_deal'+id).val();

    if(validatePrice(val)){

        $.ajax({

        type: 'GET',
            url: "{{ route('editPricedeal') }}",
            data: {
                product_id:id,
                val: val
                
            },
            success: function(result){
               window.location.reload();
               
            }
        });

    }
    else{
        alert('Giá tiền nhập không đúng định dạng');
    }
    
}


function update_order(id){

    let val = $('.edit_order'+id).val();
    console.log(val)
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({

    type: 'GET',
        url: "{{ route('order-deal') }}",
        data: {
            product_id:id,
            val: val
            
        },
        success: function(result){
            $('.edit_orders'+id).text('thành công');
           
        }
    });

}


deal_product = [];





$('.add-deal-price').click(function(){

    id_row = $('#row_id').val();

    const price = $('#price-deal').val(); 

   

   $('#row_'+id_row+' .deal-price').text(numberWithCommas(price));

   for (let i = 0; i < deal_product.length; i++) {

        if (deal_product[i].id == id_row) {


            deal_product.splice(deal_product[i], 1);

            deal_product.splice(deal_product[i], 1);
          
        }
        
    }

    deal_product.push({price_deal:price, id:id_row});


   $('#select-price').modal('hide');

});




 $("#group_product_id").bind("change", function() {

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({

        type: 'GET',
            url: "{{ route('filter-group-id') }}",
            data: {
                group_id: $( "#group_product_id" ).val(),
                action:$(this).val(),
                
            },
            success: function(result){


                $('#tb-list .row-hover').remove();
                $('#tb-list tbody').append(result);

               
            }
        });

    });

 $('.add-view').click(function(){

        edit_id = $('#edit-deal').val();

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({

        type: 'GET',
            url: "{{ route('filter-deal-add') }}",
            data: {
                data: JSON.stringify(deal_product),
                edit_id:edit_id,
               
                
            },
            success: function(result){

               window.location.reload();
            }
        });

    
 })

function changeFlashDeal(id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    type: 'POST',
        url: "{{ route('add-deal-flash') }}",
        data: {
            val: $('#flash-deal'+id).val(),
            id:id,
            
        },
        success: function(result){
           
            alert('Thành công');
            // window.location.reload();

        }
    });

}   

function kiemTraNgay(ngay) {
  const regex = /^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/;
  return regex.test(ngay);
}
function validatePrice(priceString) {

  priceString = priceString.replaceAll(".", "");  
  // Regex cơ bản để kiểm tra định dạng giá tiền
  const priceRegex = /^\d+(?:,\d{3})*(?:\.\d{1,2})?$/;

  // Xóa bỏ dấu cách và ký tự thừa
  const price = priceString.trim().replace(/[^0-9.,]/g, '');

  // Kiểm tra định dạng giá tiền
  if (!priceRegex.test(price)) {
    return false;
  }

  // Kiểm tra giá trị tối đa (tùy chọn)
  const maxPrice = 1000000000; // Giá trị tối đa cho phép (1tỉ)
  if (parseFloat(price) > maxPrice) {
    return false;
  }

  // Giá tiền hợp lệ
  return true;
}




function set_feature(id, active){

    $.ajax({

    type: 'GET',
        url: "{{ route('active-deal') }}",
        data: {
            id: id,

            active: active,
        },
        success: function(result){

           window.location.reload();
        }
    });
}

$('.accepts-time-deal').click(function(){

    if(kiemTraNgay($('#date-picker3').val()) && kiemTraNgay($('#date-picker4').val())){
        $.ajax({

        type: 'GET',
            url: "{{ route('updateTimeDeal') }}",
            data: {
                start: $('#date-picker3').val()+','+$('#hours3').val(),

                end:$('#date-picker4').val()+','+$('#hours4').val(),
                id:$('#time-deal').val()
               
                
            },
            success: function(result){

               window.location.reload();
            }
        });
    }
    else{
        alert('Kiểm tra lại định dạng, định dạng ngày có dạng xx-xx-xxxx');
    }

    


})

const date_end = $('#date-picker2').val()+','+$('#hours2').val();


$('.accepts').click(function(){

    if(kiemTraNgay($('#date-picker1').val()) && kiemTraNgay($('#date-picker2').val())){

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({

        type: 'GET',
            url: "{{ route('result-add') }}",
            data: {
                start: $('#date-picker1').val()+','+$('#hours1').val(),

                end:$('#date-picker2').val()+','+$('#hours2').val(),

                end_old:date_end
               
            },
            success: function(result){

               window.location.reload();
            }
        });
    } 
    else{
        alert('Kiểm tra lại định dạng, định dạng ngày có dạng xx-xx-xxxx');
    }   

})




$('.accept-find').click(function(){

    data = $('#name_product').val();

    $('#modal-product .modal-body').show();

    if(data != null){

        $.ajax({

        type: 'GET',
            url: "{{ route('filter-product-deal') }}",
            data: {
                data:data,
                page:'deal',
            },
            success: function(result){

                $('#tb-list .row-hover').remove();
                $('#tb-list tbody').append(result);

            }
        });

    }

})



function delete_deal(id){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({

    type: 'GET',
        url: "{{ route('delete-deal') }}",
        data: {
            id: id,
            
        },
        success: function(result){

            window.location.reload();
        }    
    });

}

    
</script>



@endsection