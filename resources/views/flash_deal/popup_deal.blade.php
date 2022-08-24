@if(isset($data))

<tbody>
    <tr>
        <td>Thông tin khuyến mãi</td>
        <td>
            Tên khuyến mãi : <input type="text" value="{{ $data->name }}" id="name">
            <br>
            <br>
            Giá km (nhập số) : <input type="text" value="{{ $data->price }}" id="price">
        </td>
    </tr>
</tbody>

@endif