@extends('frontend.layouts.apps')
@section('content') 
<link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}?ver=1"> 

<link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}?ver=1"> 
<link rel="stylesheet" type="text/css" href="{{ asset('css/dienmay.css') }}?ver=1"> 
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?ver=1"> 


<style type="text/css">
    td table{
        width: 100%;
    }
    .td-info{
        padding: 0;
        text-align: center;
    }

    #text{
        display: none;
    }
    .text-h3{
        font-size: 30px;
        margin-bottom: 20px;
    }
    td{
        text-align: center;
    }

    .code{
        color: #BF0000;
        font-weight: bold;
    }
    .code-image{
        width: 36%;
    }
    @media only screen and (max-width: 767px) {
     
        .text-h3{
            margin-top: 20px !important;
        }    
    }

</style>
<div class="container">
    <h3 class="text-h3">So sánh sản phẩm</h3>
    <br>
    <div class="table-responsive-lg">
        <table id="tb_padding" border="1" bordercolor="#CCCCCC" style="width:100%">
            <tbody> 

                <?php

                    $data_id = 3;

                    $ar_gr[1] = ['Tên sản phẩm','Ảnh sản phẩm','Kích cỡ màn hình', 'Độ phân giải', 'Nơi sản xuất', 'Cổng HDMI', 'Công nghệ xử lý hình ảnh', 'Kích thước có chân, đặt bàn', 'Kích thước không chân, treo tường'];
                    $ar_gr[2] = ['Tên sản phẩm','Ảnh sản phẩm','Khối lượng giặt', 'Khối lượng sấy', 'Tốc độ quay vắt', 'Kiểu động cơ', 'Lồng giặt', 'Công nghệ giặt', 'Kích thước - Khối lượng', 'Nơi sản xuất'];
                    $ar_gr[3] = ['Tên sản phẩm','Ảnh sản phẩm','Dung tích sử dụng', 'Dung tích ngăn đá', 'Dung tích ngăn lạnh', 'Công nghệ Inverter', 'Kiểu tủ', 'Kích thước - Khối lượng', 'Nơi sản xuất'];
                    $ar_gr[4] = ['Tên sản phẩm','Ảnh sản phẩm','Loại máy', 'Công suất làm lạnh', 'Công suất sưởi ấm', 'Phạm vi làm lạnh hiệu quả', 'Chế độ tiết kiệm điện', 'Loại Gas sử dụng', 'Nơi sản xuất', 'Năm ra mắt'];

                    $ar_gr[5] = ['Tên sản phẩm', 'Ảnh sản phẩm', 'Đặc điểm nổi bật'];  
                    $ar = $data_id<5?$ar_gr[$data_id]:$ar_gr[5];

                
                ?>

               
                @if(count($ar)>0 && isset($data))

                <?php 
                    $info_product = [];

                    $ar_sp = [];
                    foreach ($data as $keys => $value) {

                        $product = App\Models\product::find($value);

                        if($data_id <5){
                            $html = $product->Specifications;

                            $dom = new \DOMDocument();

                            $html = mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'); //convert sang tiếng việt cho dom

                            $dom->loadHTML($html);

                            foreach($dom->getElementsByTagName('td') as $td) {

                                foreach($ar as $key => $value) {

                                    if(strpos($td->nodeValue, $value)>-1){

                                        $ar_sp[$keys][$key] = str_replace($value, '', $td->nodeValue);
                                        
                                    }

                                }
                            } 

                            array_unshift($ar_sp[$keys], htmlspecialchars_decode('<img width="327" class="code-image" src="'.asset($product->Image).'">'));
                            array_unshift($ar_sp[$keys], $product->Name);
                        }
                        else{
                            $ar_sp[$keys][0] = $product->Name;
                            $ar_sp[$keys][1] = '<img width="327" class="code-image" src="'.asset($product->Image).'">';
                            $ar_sp[$keys][2] = $product->Salient_Features;
                        }


                    }
                    
                ?>

                
                @foreach($ar as $key=> $filters)
                
                <tr>
                    <td><b>{{ $filters }}</b></td>

                    @foreach($ar_sp as  $info_productss)

                    <td>
                        <div style="max-height:250px; overflow:auto">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="td-info">
                                             
                                            <span>  
                                                <label for="code">{!! !empty($info_productss[$key])?str_replace(':','',$info_productss[$key]):'11' !!}</label>
                                            </span>

                                        </td>
                                        
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </td>
                   
                   
                    @endforeach
                </tr>
                @endforeach
                @endif
                
            </tbody>
        </table>
    </div>
    
</div>


@endsection