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

    <a href="{{ Route('update-sheet->post') }}">cập nhật giá từ sheet</a>
    <div>
        <h1>Bảng Giá Sản Phẩm</h1>
    </div>
    
    <table id="priceTable">
        <thead>
            <tr>
                <th>stt</th>
                <th>Model(trên sheet)</th>
                <th>Giá trên Sheet</th>
                <th>Giá hiện tại(thường)</th>
                <th>Giá cũ</th>
                <th>Thời gian cập nhật</th>
                <th>Model(trên website)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @if(!empty($response->values))

            <?php 

                $dem =0;
            ?>

            @foreach($response->values as $val)

            <?php 

                $dem++;
            ?>
            <tr>
                <td>{{ $dem }}</td>
                <td>{{ $val[0] }}</td>
                <td>{{ @str_replace(',' ,'.', number_format( str_replace('.', '', $val[1]))) }}</td>

                <?php 


                    $product = DB::table('products')->select('Price', 'id', 'ProductSku','updated_at')->where('ProductSku', $val[0])->first();

                    $old_data_price ='';

                    if(!empty($product)){
                        $old_data_price = DB::table('history_product')->select('price_old')->where('product_id', $product->id)->get()->last();
                    }

                    
                ?>
                <td>{{ @str_replace(',' ,'.', number_format( str_replace('.', '', $product->Price))) }}</td>
                @if(!empty($product->id) && !empty($old_data_price))
                <td>{{ @str_replace(',' ,'.', number_format( str_replace('.', '', $old_data_price->price_old)))  }}</td>
                @else
                <td></td>
                @endif
                <td>{{ @Carbon\Carbon::parse($product->updated_at)->format('d/m/Y H:i:s') }}</td>
                <td>{{ @$product->ProductSku }}</td>
                <td>Pending</td>
            </tr>
            @endforeach
            @endif
            
        </tbody>
    </table>

    <script type="text/javascript">
        function update_price_to_sheet(rowIndex) {
             // Lấy bảng
            const table = document.getElementById('priceTable');

            const totalRows = table.rows.length;

            
            // Kiểm tra dòng trên có tồn tại không
            if (rowIndex <= 1) {
                alert('Không có dòng trước dòng hiện tại!');
                return;
            }

            // Lấy dòng trên
            const previousRow = table.rows[rowIndex - 1];

            // Duyệt qua các ô của dòng trên và lấy dữ liệu
            const rowData = [];
            for (let cell of previousRow.cells) {
                rowData.push(cell.textContent.trim());
            }

            // Hiển thị dữ liệu
            // console.log('Dữ liệu dòng trên:', rowData);

            console.log(totalRows);
        }

        // ['1','83M4PSA', '145.000.000', '145.000.000', '', '2025-01-23', '83M4PSA', 'done'];

        // function updatePreviousRow(currentRowIndex, newData) {
        //     // Lấy bảng
        //     const table = document.getElementById('priceTable');

        //     // Kiểm tra nếu dòng trước tồn tại
        //     if (currentRowIndex <= 1) {
        //         alert('Không có dòng trên để cập nhật!');
        //         return;
        //     }

        //     // Lấy dòng trên
        //     const previousRow = table.rows[currentRowIndex - 1];

        //     // Cập nhật dữ liệu  trong dòng trên
           
        //     previousRow.cells[currentRowIndex].textContent = newData;

           

        //     // alert(`Dòng trên (dòng ${currentRowIndex - 1}) đã được cập nhật!`);
        // }
    </script>
</body>


</html>
@endsection