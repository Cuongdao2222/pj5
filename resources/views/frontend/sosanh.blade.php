<table id="tb_padding" border="1" bordercolor="#CCCCCC" style="width:100%">
    <tbody> 

        <?php

            $_GET['groupid'] = 1;

            $group_id  = 279;

            $_GET['productId'] = 4083;

            $group_id = $_GET['groupid']??$_GET['group-product'];


           
            $filter = App\Models\filter::where('group_product_id', $group_id)->get();
        ?>
        @if(count($filter)>0)
        @foreach($filter as $filters)
        <tr>
            <?php  
                $arr_value = json_decode($filters->value,true);


                $property = App\Models\property::where('filterId', $filters->id)->get();
            ?>
            <td width="120px"><b>{{ $filters->name }}</b><br><span style="color:red">Dùng là thông số</span></td>
            <td>
                <div style="max-height:250px; overflow:auto">
                    <table>
                        <tbody>
                            <tr>
                            @if(isset($property))

                                <?php  
                                    $product_id = $_GET['productId'];



                                ?>

                                @if($product_id !=0)

                                    @foreach($property as $propertys)

                                    <?php

                                        $search_arr = $filters->value;

                                    ?>

                                    <td valign="top">
                                        <span>  

                                            @if(isset($arr_value[$propertys->id])&& in_array($product_id  ,$arr_value[$propertys->id]))
                                                <label for="code" data-id="{{ $propertys->id }}">{{ $propertys->name }}</label>
                                            @endif
                                        </span>
                                    </td>

                                       
                                    @endforeach
                                @else


                                @foreach($property as $propertys)

                                <?php

                                    $search_arr = $filters->value;

                                   
                                ?>

                                <td valign="top"><span><input type="checkbox"> <label for="code" data-id="{{ $propertys->id }}">{{ $propertys->name }}</label></span><br></td>
                                @endforeach

                                @endif
                                
                            @endif
                                
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