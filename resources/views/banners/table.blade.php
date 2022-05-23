<?php 
    $option[0] = ['name'=>'Banner slide home', 'size'=>'1920px x 630px'];
    $option[1] = ['name'=>'Banner top', 'size'=>'1920px x 44px'];
    $option[2] = ['name'=>'Banner bên phải slider home', 'size'=>'254px x 254px'];
    $option[3] = ['name'=>'Banner dưới slider home', 'size'=>'690px x 305px'];
    $option[4] = ['name'=>'Banner category', 'size'=>'1200 x 200px'];
    $option[5] = ['name'=>'Banner trên phần sale home', 'size'=>'1200 x 90'];

?>
<?php  

    $optionss = $_GET['option']??'';

    $i =0 ;

?>
<select name="option" onchange="location = this.value;">
    @foreach($option as $key => $options)
    <option value="{{ route('banners.index') }}?option={{ $key }}" {{ $key == $optionss?'selected':''  }}>{{ $options['name'] }}</option>
 
    @endforeach
</select>


<table id="tb_padding" border="1" bordercolor="#CCCCCC" width="100%">
    <tbody>
        <tr style="background-color:#EEE; font-weight:bold;">
            <td style="width:40px">STT</td>
            <td>Thông tin</td>
            <td style="width:60px">Thứ tự</td>
            <td style="width:60px">Click</td>
            <td style="width:130px">Chỉnh sửa</td>
        </tr>
         @foreach($banners as $banner)
         <?php 

            $i++;
         ?>
        <tr id="row_402" onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="row-hover">
            <td>{{ $i }}</td>
            <!--<td><a class='preview_media' href="javascript:;">Xem nhanh <span></span></a></td>-->    
            <td>
                <div class="peek-view-banner"><img border="0" src="{{ asset($banner->image) }}" width="200" ></div>
                <b style="color:#F00">Thông tin</b><br>
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>Tên gọi</td>
                            <td>: <b>{{ $banner->title }}</b></td>
                        </tr>
                       
                        <tr>
                            <td>File</td>
                            <td>: <input type="text" readonly="" size="80" value="/media/banner/15_Aprd99119ca42e35bfa7fbc7fba9ab1d88a.jpg"></td>
                        </tr>
                        <tr>
                            <td>Kích thước</td>
                            <td>: Rộng x Cao (Width x Height) = {{ $option[$banner->option]['size']  }} </td>
                        </tr>
                        <tr>
                            <td>Link</td>
                            <td>: <input type="text" readonly="" size="35" value="{{ $banner->link }}"></td>
                        </tr>
                        <tr>
                            <td>Thời gian</td>
                            <td>{{ @$banner->updated_at->format('d/m/Y')  }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
               
                <input id="stt{{ $banner->id }}" type="text" size="5" value="{{ $banner->stt }}" onchange="update_banner_order('{{ $banner->id }}')">
                 <span id="order_{{ $banner->id }}"></span>
                
            </td>
            <td>0</td>
            <td>
                <span id="status_402">
                <a href="{{ route('active-banner') }}?id={{ $banner->id }}&active={{ $banner->active==0?1:0 }}">{{ $banner->active==0?'Bật lên':'Hạ xuống' }}</a>
                </span> 
                <br> 
                <a href="{{ route('banners.edit', [$banner->id]) }}">Sửa lại</a> <br>
                <!-- <a href="javascript:void(0);" onclick="delete_this('402')">Xóa</a> -->
            </td>
        </tr>
        @endforeach
      
    </tbody>
</table>
<script type="text/javascript">
    
    function update_banner_order(id) {

       
        $.ajax({
       
        type: 'GET',
            url: "{{ route('editBnstt') }}",
            data: {
                id: id,
                val:$('#stt'+id).val(),
                
            },
            success: function(result){

                $('#order_'+id).text('');

                $('#order_'+id).text('Thành công');

                
            }
        });
    }
</script>
