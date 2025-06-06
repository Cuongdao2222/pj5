<style type="text/css">
    .border1{
        border: 2px solid #e74032;

    }
</style>

<style type="text/css">
    .button{
        cursor: pointer;
        border-radius: 5px;
        padding: 5px;
    }

</style>
<?php
    $Group = App\Models\groupProduct::select('id', 'name')->get();
    $maker = App\Models\maker::select('id', 'maker')->get();
    $Groups = [];
    $makers  = [];
    if(!empty($product)){
        $GroupSelected = ($product->toArray())['Group_id'];
        $LinkSelected = ''.($product->toArray())['Link'];
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
    $mota = $_GET['mota']??'';  
    $specifications_view = $_GET['specifications']??'';
    $seo = $_GET['seo']??'';
    
?>

<!-- <div class="col-md-12">
     <button>Seo sản phẩm</button><br>
</div> -->


<?php  $url_domain =  Config::get('app.url') ?>

@if(!empty($specifications_view))
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Specifications', 'Thông số kỹ thuật:') !!}
    {!! Form::textarea('Specifications', null, ['class' => 'form-control', 'id' =>'content-2']) !!}
</div>
@endif

@if(!empty($mota))
<div class="btn-primary button" onclick ='removeHref()'>Xóa link content</div>


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Detail', 'Mô tả: '.$product->Name??'', ['id' =>'mo-ta'], ['rel' =>'nofollow']) !!}
    {!! Form::textarea('Detail', null, ['class' => 'form-control', 'id' =>'content']) !!}
</div>



    @if(isset($product->id))

    <?php  

        $imagecontent = App\Models\imagescontent::where('product_id', $product->id)->where('option',1)->get()
    ?>

    <div><a href="javascript:void(0)" onclick="clickChangeImageContent()">Thêm ảnh content</a></div>

        <div class="col-md-12 col-sm-12">
        
        <div id="article_media_holder">
        <style type="text/css">
            a.preview_media{
            position:relative; /*this is the key*/
            z-index:24;}
            a.preview_media:hover{z-index:25; cursor:pointer}
            a.preview_media span{display: none}
            a.preview_media:hover span{
            display:block;
            position:absolute;
            top:-120px; left:50px; width:auto;
            text-align: center}
        </style>
        <table class="big_table" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="3">
            <tbody>
                <tr>
                    
                    @if(isset($matches[1]))
                    @foreach($matches[1] as $key => $value)
                    <?php 
                        $value = str_replace(['http://dienmaynguoiviet.net', 'https://dienmaynguoiviet.net'], 'https://dienmaynguoiviet.vn', $value); 
                    ?>
                    <td class="img{{ $key }} tdimg"><a href="javascript:void(0);" onclick="clicks('images{{ $key }}', '{{ asset($value) }}')"><img src="{{ asset($value) }}" style="max-width:100px; max-height:130px" id="img{{ $key }}"></a></td>
                 
                    @endforeach
                    @endif
                </tr>
                
               
            </tbody>

        </table>

       
        <br>
        
        <br>
    </div>

    <table class="big_table" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="3">
        <tbody>
            <tr>

                @if(isset($imagecontent))
                @foreach($imagecontent as $key => $values)
                <?php 
                    $images = str_replace(['http://dienmaynguoiviet.net', 'https://dienmaynguoiviet.net'], 'https://dienmaynguoiviet.vn', $values->image);

                   

                ?> 
                <td class="img1{{ $key }}"><a href="javascript:void(0);" onclick="click1('images1{{ $key }}', '{{ asset($images) }}')"><img src="{{ asset($images) }}" style="max-width:100px; max-height:130px" id="img1{{ $key }}"></a></td>
             
                @endforeach
                @endif
            </tr>
            
           
        </tbody>

    </table>
    @endif

@endif

@if(empty($specifications_view)&&empty($mota)&&empty($seo))

<!-- Product Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Name', 'Tên sản phẩm:') !!}
    {!! Form::text('Name', null, ['class' => 'form-control','maxlength' => 1000]) !!}
</div>

<!-- Productsku Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ProductSku', 'Model:') !!}
    {!! Form::text('ProductSku', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Price', 'Giá:') !!}
    {!! Form::text('Price', null, ['class' => 'form-control']) !!}

</div>


<div class="form-group col-sm-6">
    {!! Form::label('manu Price', 'Giá Hãng:') !!}
    {!! Form::text('manuPrice', null, ['id'=>'manuPrice' ,'class' => 'form-control']) !!}

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
           $('#Link').val(toSlug(slug));
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

<!-- Link Redirect Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Link Redirect', 'Link Redirect:') !!}
    {!! Form::text('LinkRedirect', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Salient_Features', 'Đặc điểm nổi bật') !!}
    {!! Form::textarea('Salient_Features', null, ['class' => 'form-control', 'id' =>'content-1']) !!}
</div>

<!-- promotion -->
<div class="form-group col-sm-6">
    <a href="javascript:void(0)" onclick="show_Product()">chọn sản phẩm cho nhóm</a>
    <br>
    {!! Form::label('Km', 'Khuyến mãi text:') !!}
    {!! Form::textarea('promotion', null, ['class' => 'form-control', 'id' =>'promotion']) !!}
</div>

<div class="form-group col-sm-6">

    <br>
    {!! Form::label('GiftPrice', 'Giá trị quà ước tính:') !!}
    {!! Form::text('GiftPrice', null, ['class' => 'form-control']) !!}

</div>

<!-- Image Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('Image', 'Image:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('Image', ['class' => 'custom-file-input']) !!}
            {!! Form::label('Image', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div> -->
<div class="clearfix"></div>
@endif


<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <?php  
               
                    $option = App\Models\groupProduct::select('id', 'name')->where('parent_id', 0)->get();
                ?>

               
                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                 <h5 class="modal-title" id="exampleModalLabel">Nhập model</h5>

                 <input type="text" name="" id="name_product">
                 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                 <div class="btn-primary accept-find" style="width:22%">xác nhận</div>

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
                                <input type="button" value="Chọn sản phẩm" class="update-bt-all" data-id="{{$val->id}}"><span id="update_bt_5814"></span>
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


<script type="text/javascript">

    var ar_pd_add = [];


    $(document).ready(function() {
        getContent();
    });


    $('.accept-find').click(function(){

        data = $('#name_product').val();

        $('#modal-product .modal-body').show();

        if(data != null){

            $.ajax({

            type: 'GET',
                url: "{{ route('filter-product-deal') }}",
                data: {
                    data:data,
                    page:'pd',
                },
                success: function(result){

                    
                    $('#tb-list tbody').append(result);

                }
            });

        }

    });



    $('.add-view').click(function () {

        data = JSON.stringify(ar_pd_add);

        $.ajax({

        type: 'GET',
            url: "{{ route('show-product-group-promotion') }}",
            data: {
                data:data,
                
            },
            success: function(result){
            
                result = JSON.parse(result);

                price = sumArray(result[1]);

                name = result[0];

                link =  result[2].toString();

                editor = CKEDITOR.instances['promotion'];

                editor1 = CKEDITOR.instances['content-1'];

                // update price in input

                $('#manuPrice').val(price);

                editor.setData(name);

                editor1.setData(link);
               
                $('#modal-product').modal('hide');

                // console.log(namestring);
            }
        });
        
        
    })

   
  

    function show_Product() {
        $('#modal-product').modal('show');
    }


    function sumArray(mang){
        let sum = 0;
        mang.forEach(function(value){
            sum += value;
        });
         
        return sum;
    }
        
    function getContent() {
         
        @if (\Session::has('success-content'))

            let item_local_store =  localStorage.getItem('infoDetailsPost');

            CKEDITOR.instances['content'].setData(item_local_store)

        @endif
        
    }


    
    function clickChangeImageContent() {

        localStorage.removeItem('infoDetailsPost');

        content = CKEDITOR.instances['content'].getData();
       
        localStorage.setItem('infoDetailsPost', content);

        @if(!empty($product->id))
      
        url = '{{ route('imagescontent', $product->id) }}?option=1';
        $(location).attr('href',url);
        @endif

    }

     function removeHref() {

        let content = CKEDITOR.instances.content.getData();

        var regex = /(<\s*a([^>]+)>|<\/\s*a\s*>)/ig;

        contents = content.replace(regex, ""); 

        CKEDITOR.instances.content.setData(contents);
    }

    function code() {
        CKEDITOR.instances['content'].insertText('cuong');
    }
    var activeReplace = [];
   
    function clicks(id,src) {
        editor = CKEDITOR.instances.content;
        var documentWrapper = editor.document; // replace by your CKEDitor instance ID
        var documentNode = documentWrapper.$; // or documentWrapper['$'] ;
        var edata = editor.getData();
        documentNode.getElementById(id).scrollIntoView();
        ids = id.replace('images', 'img');
        $('.tdimg').removeClass('border1');
        activeReplace.push(src);
        activeReplace.push(id);
        activeReplace.push(ids);
        $('.'+ids).addClass('border1');
         console.log(activeReplace);
    }

    function click1(id, src) {

        if(activeReplace.length==0){
            img = '<img src="'+src+'">';
            CKEDITOR.instances['content'].insertHtml(img);
            
        }
        else{
            editor = CKEDITOR.instances.content;
            var documentWrapper = editor.document; // replace by your CKEDitor instance ID
            var documentNode = documentWrapper.$; // or documentWrapper['$'] ;
            var edata = editor.getData();
            var replaced_text = edata.replace(activeReplace[0], src); // you could also use a regex in the replace 
            editor.setData(replaced_text);
            documentNode.getElementById(activeReplace[1]).scrollIntoView();
            $('#'+activeReplace[2]).attr('src', src);
            activeReplace.pop();
            activeReplace.pop();
            activeReplace.pop();
            $('.tdimg').removeClass('border1');
        }
       
    }
    
</script>



<script>
    CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: '{{ $url_domain }}ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700',
    });
    CKEDITOR.replace( 'content-1', {
        filebrowserBrowseUrl: '{{ $url_domain }}ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700'
    });
    CKEDITOR.replace( 'content-2', {
        filebrowserBrowseUrl: '{{ $url_domain }}ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700'
    });

    CKEDITOR.replace( 'promotion', {
        filebrowserBrowseUrl: '{{ $url_domain }}ckfinder.html',
        filebrowserImageBrowseUrl: '{{ $url_domain }}/ckfinder.html?Type=Images',
        filebrowserUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ $url_domain }}/js/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserWindowWidth : '1000',
        filebrowserWindowHeight : '700'
    });
    
    
</script>

