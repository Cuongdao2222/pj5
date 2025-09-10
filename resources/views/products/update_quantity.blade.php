@extends('layouts.app')

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        
    }
    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
</style>

@section('content')
<body>

    <div style="height:100px"></div>

  

     <a href="javascript:void(0)" onclick="updatePreviousRow()">cập nhật tồn từ sheet</a>

    @if(!empty($response['values']))

        <?php 
            $data_quantity = $response['values'];
            $dem =0;
            $dems = 0;
        ?>

    <div>
        <h3>Bảng nhóm sản phẩm sẽ reset   </h3>
        <ul>
            @for ($i=1; $i < count($data_quantity); $i++)
            <?php 
                $dems++;
                $group_name = DB::table('group_product')->select('name','id')->where('id', $data_quantity[$i][1])->first();
            ?>

            <li>{{ @$group_name->name  }}</li>
            @endfor
        </ul>
    </div>
    <div>
        <h4>Cập nhật tồn random(5-15) cho các model sản phẩm dưới</h4>
    </div>
    
    <table id="priceTable">
        <thead>
            <tr>
                <th>stt</th>
                <th>Model(trên sheet)</th>
                
               
            </tr>
        </thead>
        <tbody>


           

            @for ($i=1; $i < count($data_quantity); $i++)

            <?php 

                $dem++;
            ?>
            <tr>
                <td>{{ $dem }}</td>
                <td>{{ $data_quantity[$i][0] }}</td>
               
            </tr>
            @endfor
           
            
        </tbody>
    </table>
    @endif

</body>


</html>
@endsection