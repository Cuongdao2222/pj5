@extends('frontend.layouts.apps')

@section('content')

     <style type="text/css"> 
        .item-form{
            text-align: left;
        }
        ul li{
            font-size: 14px !important;
        }
        .item-form input{
            width: 100%;
            border: 1px solid #dddddd;
            padding: 5px;
        }

        .form-post{
            margin-bottom: 20px;
        }



        .item-form .error{
            color: red;
        }

        .cart_col_1 {
            width: 23%;
        }

        .cart_col_2 {
            width: 44%;
        }

        .product_list_cart .cart_col_3 {
            width: 36%;
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product_list_cart .col_price{
            color: #c10017;
        }

        .option-group .step_option {
            float: left;
            cursor: pointer;
            text-align: left;
            margin-bottom: 0px;
            width: auto !important;
            margin-right: 25px;
        }

        .st_opt_active {
            background: #0e76bd;
        }

        .st_opt {
            display: block;
            width: 16px;
            height: 16px;
            cursor: pointer;
            float: left;
            border: 1px solid #b2b2b2;
            margin-right: 10px;
            border-radius: 50%;
        }

        .total-cart-price, .cart-foot span {
            color: #c10017;
            font-weight: bold;
        }
        .discount-div{
            border: 0;
        } 
        .c3_box .item-form {
            padding: 5px 15px;
        }

        .c3_box textarea {
            display: block;
            padding: 9px 0;
            height: 105px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            margin: 10px 0 5px;
            text-indent: 10px;
            width: 100%;
            outline: none;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .product_list_cart{
            display: flex;
        }

        .product_list_cart .col_input input, .product_list_cart .col_input a {
            width: 35px;
            height: 30px;
            text-align: center;
            display: inline-block;
            border: 1px solid #ccc;
            line-height: 30px;
            float: right;
            margin-right: -1px;
            background-color: transparent;
        }
        #tbl_list_cartss{
            height: auto;
            padding: 5px 15px;
        }
    </style>

    <div id="number-product-cart" style="display:none">{{ count($data_cart) }}</div>

    <div class="row">
        
        <div class="span16 container form-post">
            @if(count($data_cart)>0)
            <h5 class="modal-title" id="exampleModalLabel">Thông tin giỏ hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
        
       
            <div id="tbl_list_cartss">
                <div id="number-product-cart" style="display:none">1</div>
               
                <div style="width:100%;">

                    <?php  

                        $arrPrice = [];
                        $key = 0;
                        
                    ?>
                    @foreach($data_cart as $data)

                        <?php 

                            $price = (int)$data->price*(int)$data->qty;
                            $key++;
                            array_push($arrPrice, $price);

                            $infoProducts = App\Models\product::find($data->id);

                        ?>
                    <div class="js-item-row product_list_cart" data-variant_id="0" data-item_id="5804" data-item_type="product">
                        <div class="cart_col_1"> <a href="{{ route('details', $infoProducts->Link) }}"><img src="{{ asset($infoProducts->Image) }}" style="width: 85px;"></a> </div>
                        <div class="cart_col_2">
                            <a href="{{ route('details', $infoProducts->Link) }}"><span class="name">{{ $data->name }}</span></a> <!--//Kiem tra khuyen mai co lua chon--> 
                            <ul style="list-style-type: disc;color: #888888;margin-left: 15px;"> </ul>
                        </div>
                        <div class="cart_col_3">
                            <div class="col_price code1"> <span class="total-item-price">{{ number_format($data->price , 0, ',', '.')}} </span> đ </div>
                            <div class="col_input"> <a href="javascript:void(0)" class="quantity-change" title="tru" onclick="tru('{{ $key  }}', '{{ $data->rowId }}')">-</a> <input class="buy-quantity1 quantity-change" value="{{ $data->qty }}" size="5" disabled=""> <a href="javascript:void(0)" class="quantity-change" title="them" onclick="cong('{{ $key }}', '{{ $data->rowId }}')">+</a> </div>
                        </div>
                        <a href="javascript:void(0)" class="delete-from-cart" onclick="removeProductCart('{{ $data->rowId }}')"><i class="fa fa-times-circle"></i> Xóa</a> 
                    </div>

                    @endforeach
                </div>
                <!-- <div class="item-form">
                    <div> <input type="text" name="discount-code" id="discount_code" value="" placeholder="Mã giảm giá"> </div>
                    <br> 
                    <div>
                        <div class="btn btn-info add-discount add-click">Add</div>
                    </div>
                </div> -->
               <!--  <div class="cart-foot discount-div"> <b>chi phí thêm (phí lắp đặt, vận chuyển...):</b><span class="sub1 discount-price">0  x 2 </span> </div>
                <div class="cart-foot discount-div"> <b>Mã giảm giá:</b><span class="sub1 discount-price">0</span> đ</span> </div> -->
                <br>  

                 <?php 

                    $totalPrice = array_sum($arrPrice);
                ?>
                <div class="cart-foot"> <b>Tổng tiền:</b><span class="sub1 total-cart-price">{{ number_format($totalPrice , 0, ',', '.')}}</span> đ</span> </div>
                <script type="text/javascript"> function removeProductCart(id) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('removeCart') }}",
                        data: {
                            product_id: id,
                               
                        },
                        success: function(result){
                          
                            window.location.href = '{{ route('show-cart') }}'; 
                            
                        }
                    });
                    
                    
                    }
                    
                    function tru(key, rowId){
                    
                        if(!$('.add-discount').hasClass('add-click')){
                            $('.add-discount').addClass('add-click');
                        }
                        const val_number = $('.buy-quantity'+key).val();
                        val_numbers =  parseInt(val_number);
                        
                        if(val_numbers>0){
                            val_numbers = val_numbers-1;
                        
                            $.ajaxSetup({
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                        
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('addCartNumber') }}",
                                data: {
                                    rowId: rowId,
                                    number:val_numbers
                                },
                                success: function(result){
                        
                                     window.location.href = '{{ route('show-cart') }}'; 
                        
                        
                                }
                            });
                        
                            $('.buy-quantity'+key).val(val_numbers);
                            
                        }
                    }
                    
                    function cong(key, rowId){
                    
                        if(!$('.add-discount').is(':visible')){
                            $('.add-discount').show();
                        }
                        
                        const val_number = $('.buy-quantity'+key).val();
                        val_numbers =  parseInt(val_number);

                       

                        
                        if(val_numbers>=0){
                            val_numbers = val_numbers+1;

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                        
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('addCartNumber')  }}",
                                data: {
                                    rowId: rowId,
                                    number:val_numbers
                                },
                                success: function(result){
                        
                                    window.location.href = '{{ route('show-cart') }}'; 
                        
                                  
                                    
                                }
                            });
                        
                          
                        }
                    }
                    
                    $('.add-click').click(function () {
                    
                    const discount = $('#discount_code').val();
                    
                    $.ajax({
                        type: 'POST',
                        url: "https://muasamtaikho.vn/admins/add-discount",
                        data: {
                            discount: discount,
                           
                        },
                        success: function(result){
                    
                            $('.add-discount').hide();
                    
                            if(result ==0){
                                alert('Mã giảm giá không đúng hoặc đã được sử dụng hết. Vui lòng kiểm tra lại')
                            }
                            else{
                                var price =  $('.total-cart-price').text().replaceAll('.','');
                        
                                price = price - parseInt(result);
                                          
                                formattedPrice = price.toLocaleString('en-US', {
                                  style: 'currency',
                                  currency: 'VND',
                                });
                    
                                resultDiscount = parseInt(result).toLocaleString('en-US', {
                                  style: 'currency',
                                  currency: 'VND',
                                });
                    
                                $('.discount-price').text('-'+resultDiscount.replace('₫',''));
                    
                                $('.total-cart-price').text(formattedPrice.replace('₫',''));
                    
                            }
                            
                        }
                    });
                    }) 
                </script> 
            </div>
            <div class="c3_col_1 form-info-cart">
                <form class="c3_box" id="form-sub" method="post" action="{{ route('order') }}" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="title_box_cart"> Thông tin khách hàng</div>
                    <div class="item-form">
                        <div class="option-group clearfix">
                            <div class="step_option"> <span class="st_opt st_opt_active" data-value="Anh" data-name="sex"></span><span>Anh</span> </div>
                            <div class="step_option"> <span class="st_opt" data-value="Chị" data-name="sex"></span><span>Chị</span> </div>
                            <input type="hidden" name="sex" id="sex" value="Nam"> 
                        </div>
                        <!--option-group--> 
                    </div>
                    <div class="item-form"> <input type="text" name="name" id="buyer_name" placeholder="Họ tên"> </div>
                    <div class="item-form"> <input type="text" name="phone_number" id="buyer_tel" value="" placeholder="Số điện thoại"> </div>
                    <div class="item-form"> <input type="text" name="mail" id="buyer_email" value="" placeholder="Email"> </div>
                    <div class="item-form"> <textarea name="address" placeholder="Địa chỉ" id="buyer_address"></textarea> </div>
                    <div class="item-form" style="width: 50%;display: inline-block;color: #0083d1;">
                        <select name="province" class="form-control" id="ship_to_province" onchange="getDistrict(this.value)">
                            <option value="0">--Lựa chọn--</option>
                            <option value="1">Hà nội</option>
                            <option value="2">TP HCM</option>
                            <option value="5">Hải Phòng</option>
                            <option value="4">Đà Nẵng</option>
                            <option value="6">An Giang</option>
                            <option value="7">Bà Rịa-Vũng Tàu</option>
                            <option value="13">Bình Dương</option>
                            <option value="15">Bình Phước</option>
                            <option value="16">Bình Thuận</option>
                            <option value="14">Bình Định</option>
                            <option value="8">Bạc Liêu</option>
                            <option value="10">Bắc Giang</option>
                            <option value="9">Bắc Kạn</option>
                            <option value="11">Bắc Ninh</option>
                            <option value="12">Bến Tre</option>
                            <option value="18">Cao Bằng</option>
                            <option value="17">Cà Mau</option>
                            <option value="3">Cần Thơ</option>
                            <option value="24">Gia Lai</option>
                            <option value="25">Hà Giang</option>
                            <option value="26">Hà Nam</option>
                            <option value="27">Hà Tĩnh</option>
                            <option value="30">Hòa Bình</option>
                            <option value="28">Hải Dương</option>
                            <option value="29">Hậu Giang</option>
                            <option value="31">Hưng Yên</option>
                            <option value="32">Khánh Hòa</option>
                            <option value="33">Kiên Giang</option>
                            <option value="34">Kon Tum</option>
                            <option value="35">Lai Châu</option>
                            <option value="38">Lào Cai</option>
                            <option value="36">Lâm Đồng</option>
                            <option value="37">Lạng Sơn</option>
                            <option value="39">Long An</option>
                            <option value="40">Nam Định</option>
                            <option value="41">Nghệ An</option>
                            <option value="42">Ninh Bình</option>
                            <option value="43">Ninh Thuận</option>
                            <option value="44">Phú Thọ</option>
                            <option value="45">Phú Yên</option>
                            <option value="46">Quảng Bình</option>
                            <option value="47">Quảng Nam</option>
                            <option value="48">Quảng Ngãi</option>
                            <option value="49">Quảng Ninh</option>
                            <option value="50">Quảng Trị</option>
                            <option value="51">Sóc Trăng</option>
                            <option value="52">Sơn La</option>
                            <option value="53">Tây Ninh</option>
                            <option value="56">Thanh Hóa</option>
                            <option value="54">Thái Bình</option>
                            <option value="55">Thái Nguyên</option>
                            <option value="57">Thừa Thiên-Huế</option>
                            <option value="58">Tiền Giang</option>
                            <option value="59">Trà Vinh</option>
                            <option value="60">Tuyên Quang</option>
                            <option value="61">Vĩnh Long</option>
                            <option value="62">Vĩnh Phúc</option>
                            <option value="63">Yên Bái</option>
                            <option value="19">Đắk Lắk</option>
                            <option value="22">Đồng Nai</option>
                            <option value="23">Đồng Tháp</option>
                            <option value="21">Điện Biên</option>
                            <option value="20">Đăk Nông</option>
                        </select>
                    </div>
                    <div id="district-holder-login" style="width: 49%;display: inline-block;color: #0083d1;"></div>
                    <!-- <div id="ajxTaxInvoice" class="item-form"> <div class="ng_ml"> <input type="checkbox" onclick="showTap('pnlTaxInvoice')" name="chkTaxInvoice" id="chkTaxInvoice"> <label id="bale_ml" for="chkTaxInvoice">Xuất hóa đơn công ty</label> </div> <div style="width: 100%; margin-top:10px; padding: 0px;display: none;" id="pnlTaxInvoice"> <table width="100%" cellspacing="0" cellpadding="0" border="0"> <tbody> <tr> <td width="120" align="left">Công ty/Tổ chức: </td> <td align="left"> <input type="text" id="txtTaxName" value="" size="50" name="user_info[tax_company]"> </td> </tr> <tr> <td width="120" align="left">Địa chỉ: </td> <td align="left"> <input type="text" id="txtTaxAddress" value="" size="50" name="user_info[tax_address]"> </td> </tr> <tr> <td width="120" align="left">Mã số thuế: </td> <td align="left"> <input type="text" id="txtTaxCode" name="user_info[tax_code]" value=""> <span class="cmt" id="txtTaxCodeView">&nbsp;</span> </td> </tr> </tbody> </table> </div> </div> --> <!--ajxTaxInvoice--> 
                    <div class="item-form">
                        <table style="width:100%;">
                            <tbody>
                                <tr class="item-paymethod">
                                    <td><input type="radio" style="width:initial; padding:0; margin:0; height:auto;" name="pay_method" value="3" class="pay_option" id="paymethod_3" checked=""></td>
                                    <td>
                                        <label for="paymethod_3">Trả tiền khi nhận hàng</label> 
                                        <div id="pay_2" style="display:none;" class="pay_content">Trả tiền khi nhận hàng</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                     <button type="submit" class="btn btn-primary order1">Đặt hàng</button>  </div>
                </form>
            </div>
            <style type="text/css"> .cart-container {
                text-align: center;
                padding: 20px;
                /*                                    border: 1px solid #ccc;*/
                border-radius: 8px;
                background-color: #fff;
                }
                .empty-cart-message {
                font-size: 18px;
                color: #555;
                margin-top: 30px;
                }
                .cart-icon {
                font-size: 40px;
                color: #ccc;
                }
                #exampleModal .modal-body{
                min-height: 200px;
                } 
            </style>
            <div class="cart-container hide">
                <div class="cart-icon">🛒</div>
                <div class="empty-cart-message">
                    <p>Không có sản phẩm nào trong giỏ hàng</p>
                </div>
            </div>

             @else
            <div class="cart-container {{ $number_cart>0?'hide':'' }}">
            <div class="cart-icon">🛒</div>
            <div class="empty-cart-message">
                <p>Không có sản phẩm nào trong giỏ hàng</p>
                
            </div>
            @endif
        </div> 
       
    </div>

</div>

@push('js')

    <script type="text/javascript">
        $( "#form-sub" ).submit(function( event ) {

          
            const numberProduct =  parseInt($('#number-product-cart').text()) ;

            if($('#ship_to_province').val()==0){

                alert('vui lòng lựa chọn thành phố');
                event.preventDefault();   
            }
            else if($('#buyer_tel').val().length<10){
                alert('vui kiểm tra lại trường số điện thoai');
                event.preventDefault();  
            }
            else if($('#buyer_address').val().length==0){
                alert('vui kiểm tra lại trường địa chỉ');
                event.preventDefault(); 
            }
        });
        
    </script>

    
@endpush    

@endsection
