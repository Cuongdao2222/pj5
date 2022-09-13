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

                    $filter = [['name'=>'Tên sản phẩm'], ['name'=>'Ảnh'], ['name'=>'Giá bán'],  ['name'=>'Đặc điểm nổi bật']];
                
                ?>

               
                @if(count($filter)>0 && isset($data))

                <?php 
                    $info_product = [];
                    foreach ($data as $key => $value) {

                        $product = App\Models\product::find($value);

                        $info_products = [$product->Name, '<img width="327" style="width:50%" src="'.asset($product->Image).'">',  str_replace(',' ,'.', number_format($product->Price)).' đ',  str_replace(array("Đặc điểm nổi bật", "Xem thêm"), '',  html_entity_decode($product->Salient_Features))];

                        array_push($info_product, $info_products);
                    }
                ?>
                @foreach($filter as $key=> $filters)
                
                <tr>
                    <td><b>{{ $filters['name'] }}</b></td>

                    @foreach($info_product as $info_productss)

                    <td>
                        <div style="max-height:250px; overflow:auto">
                            <table>
                                <tbody>
                                    <tr>
                                        
                                        <td class="td-info">
                                            <span>  
                                                <label for="code" class="{{ $key==2?'code':'' }}" >{!! $info_productss[$key] !!}</label>
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