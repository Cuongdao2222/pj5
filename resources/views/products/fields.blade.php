<?php
    $Group = App\Models\groupProduct::select('id', 'name')->get();
    $maker = App\Models\maker::select('id', 'maker')->get();

    $Groups = [];
    $makers  = [];

    if(!empty($product)){

        $GroupSelected = ($product->toArray())['Group_id'];

        $LinkSelected = '/'.($product->toArray())['Link'];

        $MakerSelected = ($product->toArray())['Maker'];

    }

    if(count($Group)>0){
        foreach ($Group as $key => $value) {
            $Groups[$value->id] =  $value->name;
        }
    }
    
    if(count($maker)>0){
        foreach ($maker as $key => $values) {
            $makers[$values->id] =  $values->maker;
        }
    }    
    
?>


   

<!-- <div class="col-md-12">
     <button>Seo sản phẩm</button><br>
</div> -->


<?php  $url_domain =  Config::get('app.url') ?>

<!-- Product Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Name', 'Tên sản phẩm:') !!}
    {!! Form::text('Name', null, ['class' => 'form-control','maxlength' => 1000]) !!}
</div>

<!-- Productsku Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ProductSku', 'Productsku:') !!}
    {!! Form::text('ProductSku', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Price', 'Giá:') !!}
    {!! Form::text('Price', null, ['class' => 'form-control']) !!}

</div>

<!-- Link Field -->
<div class="form-group col-sm-6">


    {!! Form::label('Link', 'Link:') !!}
    {!! Form::text('Link', @$LinkSelected, ['class' => 'form-control', 'disabled']) !!}
    <div class="link" onclick="removeClick()" style="width: 10%; border: 1px solid red; padding: 5px; margin-top: 10px;">Link khác</div>

    <script type="text/javascript">

        function toSlug(str) {
            // Chuyển hết sang chữ thường
            str = str.toLowerCase();  
         
            // xóa dấu
            str = str
                .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp
         
            // Thay ký tự đĐ
            str = str.replace(/[đĐ]/g, 'd');
            
            // Xóa ký tự đặc biệt
            str = str.replace(/([^0-9a-z-\s])/g, '');
         
            // Xóa khoảng trắng thay bằng ký tự -
            str = str.replace(/(\s+)/g, '-');
            
            // Xóa ký tự - liên tiếp
            str = str.replace(/-+/g, '-');
         
            // xóa phần dư - ở đầu & cuối
            str = str.replace(/^-+|-+$/g, '');
         
            // return
            return str;
        }

        var slug = '';


        // lấy slug từ name vào input
        $('#Name').blur(function(){
           slug = $('#Name').val();
           $('#Link').val('/'+toSlug(slug));
        });

        $('#Price').change(function(){
            price = $('#Price').val();
            
            
            if(price != ''){
                $('#Price').val(numberWithCommas(price));
            }
           
        });

       function numberWithCommas(x) {

             x = x.toString().replace(',','');
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function removeClick(){
            
            document.getElementById("Link").removeAttribute("disabled"); 
        }       
        
    </script>
</div>





<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Salient_Features', 'Đặc điểm nổi bật') !!}
    {!! Form::textarea('Salient_Features', null, ['class' => 'form-control', 'id' =>'content-1']) !!}
</div>


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Specifications', 'Thông số kỹ thuật:') !!}
    {!! Form::textarea('Specifications', null, ['class' => 'form-control', 'id' =>'content-2']) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Detail', 'Mô tả:', ['id' =>'mo-ta'], ['rel' =>'nofollow']) !!}
    {!! Form::textarea('Detail', null, ['class' => 'form-control', 'id' =>'content']) !!}
</div>

<!-- Quantily Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Quantily', 'Số lượng trong kho:') !!}
    {!! Form::text('Quantily', null, ['class' => 'form-control']) !!}
</div>



<!-- Maker Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Maker', 'Hãng phân phối:') !!}
    {!! Form::select('Maker', $makers, @$MakerSelected, ['class' => 'form-control custom-select']) !!}
</div>


<?php  

    $groupProduct = App\Models\groupProduct::select('id', 'name', 'group_product_id')->get()->toArray();

    function data_tree($data, $parent_id = 0, $level = 0){
        $result = [];
        foreach($data as $item){
            if($item['group_product_id'] == $parent_id){
                $item['level'] = $level;
                $result[] = $item;
                unset($data[$item['id']]);
                $child = data_tree($data, $item['id'], $level + 1 );
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    $list_cat = data_tree($groupProduct, 0);

    $arr_new_list_cat = [];


    if(isset($list_cat)){

        foreach($list_cat as $value){
            $arr_new_list_cat[$value['id']] = str_repeat(html_entity_decode('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'), $value['level']).' - '.$value['name'];
        }  

    }  

?>


<!-- Group_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Group', 'Group:') !!}
    {!! Form::select('Group_id', $arr_new_list_cat, @$GroupSelected, ['class' => 'form-control custom-select']) !!}
   
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Image', 'Image:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('Image', ['class' => 'custom-file-input']) !!}
            {!! Form::label('Image', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<script>

    CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: '{{ $url_domain }}/ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700'
    } );

    CKEDITOR.replace( 'content-1', {
        filebrowserBrowseUrl: '{{ $url_domain }}/ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700'
    } );

    CKEDITOR.replace( 'content-2', {
        filebrowserBrowseUrl: '{{ $url_domain }}/ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700'
    } );

    
    $(document).ready(function()
    {

        $(window).bind("beforeunload", function() { 
            return confirm("Do you really want to close?"); 
        });
    });

</script>


