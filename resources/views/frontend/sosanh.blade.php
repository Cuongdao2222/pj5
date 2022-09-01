<style type="text/css">
    td table{
        width: 50%;
    }
    .td-info{
        padding: 0;
        text-align: center;
    }

    #text{
        display: none;
    }

</style>

<table id="tb_padding" border="1" bordercolor="#CCCCCC" style="width:100%">
    <tbody> 

        <?php

            $filter = [['name'=>'Tên sản phẩm'], ['name'=>'Ảnh'], ['name'=>'Giá bán'],  ['name'=>'Đặc điểm nổi bật']];

            $_GET['groupid'] = 1;

            $group_id  = 279;

            $_GET['productId'] = 4083;

            $group_id = $_GET['groupid']??$_GET['group-product'];

            $product_id = 4083;

            // $filter = App\Models\filter::where('group_product_id', $group_id)->get();

        ?>

        <?php  
            $product_id = $_GET['productId'];
            $product = App\Models\product::find($product_id);
            $info_product = [$product->Name, '<img width="327" src="'.asset($product->Image).'">',  str_replace(',' ,'.', number_format($product->Price)).' đ',  str_replace(array("Đặc điểm nổi bật", " Xem thêm"), '', $product->Salient_Features)];

        ?>
        @if(count($filter)>0)
        @foreach($filter as $key=> $filters)
        
        <tr>
            <td width="120px"><b>{{ $filters['name'] }}</b></td>

            
            <td>
                <div style="max-height:250px; overflow:auto">
                    <table>
                        <tbody>
                            <tr>
                                
                                <td class="td-info">
                                    <span>  
                                        <label for="code" >{!! $info_product[$key] !!}</label>
                                    </span>
                                </td>

                            </tr> 
                        </tbody>
                    </table>
                </div>
            </td>

            <td>
                <div style="max-height:250px; overflow:auto">
                    <table>
                        <tbody>
                            <tr>
                                
                                <td class="td-info">
                                    <span>  
                                        <label for="code" >{!! $info_product[$key] !!}</label>
                                    </span>
                                </td>

                            </tr> 
                        </tbody>
                    </table>
                </div>
            </td>

        </tr>
        @endforeach
        @endif
        
    </tbody>
</table>