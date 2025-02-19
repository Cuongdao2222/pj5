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
                <th>Giá trên Sheet</th>
                <th>Giá hiện tại(thường)</th>
                <th>Giá cũ</th>
                <th>Thời gian cập nhật</th>
                <th>Model(trên website)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @if(!empty($response['values']))

            <?php 

                $dem =0;
            ?>

            @foreach($response['values'] as $val)

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
                <td>{{ @str_replace(',' ,'.', number_format( str_replace('.', '', $old_data_price->price_old)))  }} <a href="{{ route('view-history', $product->id) }}"> lịch sử giá</a></td>
                @else
                <td></td>
                @endif
                <td>{{ @Carbon\Carbon::parse($product->updated_at)->format('d/m/Y H:i:s') }}</td>
                <td>{{ @$product->ProductSku }}</td>

                <?php 

                    $status ='';

                    if(!empty($product->Price)){
                        $status = intval(str_replace('.', '', $val[1]))=== intval(str_replace('.', '', $product->Price))?'done':'pending';
                    }    
                ?>
                <td>{{  $status  }}</td>
            </tr>
            @endforeach
            @endif
            
        </tbody>
    </table>

    <script type="text/javascript">
        function update_price_to_sheet(rowIndex) {
             // Lấy bảng
            const table = document.getElementById('priceTable');

            // const totalRows = table.rows.length;

            
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



        

        function updatePreviousRow() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            table = document.getElementById('priceTable');
            const totalRows = table.rows.length;

            // parseInt(totalRows)
            for (i = 2; i <= totalRows; i++) {

                currentRowIndex =i;
                 // Lấy dòng trên
                const previousRow = table.rows[currentRowIndex - 1];

                // Duyệt qua các ô của dòng trên và lấy dữ liệu
                const rowData = [];
                for (let cell of previousRow.cells) {
                    rowData.push(cell.textContent.trim());
                }
               

                $.ajax({
                    type: 'POST',
                    url: "{{ route('update data price sheet api') }}",
                    data: {
                        data:   JSON.stringify(rowData)
                       
                    },
                   
                    success: function(result){

                        // console.log(result);

                        window.location.reload();

                        // newData = result;

                        //  // Cập nhật dữ liệu từng ô trong dòng trên
                        // for (let j = 0; j < previousRow.cells.length; j++) {
                        //     previousRow.cells[j].textContent = newData[j] || previousRow.cells[j].textContent;
                        // }
                        
                    }
                });

            }
           
        }
    </script>
</body>


</html>
@endsection