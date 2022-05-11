<?php 
    $option[0] = ['name'=>'Banner slide home', 'size'=>'1920px x 630px'];
    $option[1] = ['name'=>'Banner top', 'size'=>'1920px x 44px'];
    $option[2] = ['name'=>'Banner bên phải slider home', 'size'=>'254px x 254px'];
    $option[3] = ['name'=>'Banner dưới slider home', 'size'=>'170px x 87px'];
    $option[4] = ['name'=>'Banner category', 'size'=>'1200 x 200px'];

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
                <div class="peek-view-banner"><img border="0" src="{{ asset($banner->image) }}" width="690" height="305"></div>
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
            <td><span id="order_402"></span>
                <input type="text" size="5" value="20" onchange="update_banner_order('402', this.value)">
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
