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

  

     <a href="javascript:void(0)" onclick="updatePreviousRow()">cập nhật giá từ sheet</a>



    <div>
        <h1>Bảng Giá Sản Phẩm</h1>
    </div>
    
    <table id="priceTable">
        <thead>
            <tr>
                <th>stt</th>
                <th>Model(trên sheet)</th>
                
               
            </tr>
        </thead>
        <tbody>


            @if(!empty($response['values']))

            <?php 
                $data_quantity = $response['values'];
                $dem =0;
            ?>

            @for ($i=1; $i < count($data_quantity); $i++)

            <?php 

                $dem++;
            ?>
            <tr>
                <td>{{ $dem }}</td>
                <td>{{ $data_quantity[$i][0] }}</td>
               
            </tr>
            @endfor
            @endif
            
        </tbody>
    </table>

</body>


</html>
@endsection