@extends('layouts.app')

@section('content')

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="info[id]" value="164654">

    <div class="group">
        <div class="group-fields">

            <table id="tb_padding">
                <tbody>

                    <form action="post" method="{{ route('create-redirect-link') }}">
                        @csrf
                        <tr>
                            <td>Link cũ</td>
                            <td><input type="text" size="80" name="request_path" id="request_path" value="" required></td>
                        </tr>
                        <tr>
                            <td>Link đích mới</td>
                            <td><input type="text" size="80" name="target_path" id="target_path" value="" required></td>
                        </tr>
                        <tr>
                            <td>Redirect Code</td>
                            <td><select name="redirect_code" id="redirect_code"><option>--Chọn--</option><option value="0">No redirect</option><option value="301" selected="">301 - Moved Permanently</option><option value="302">302 - Moved Temporarily</option></select></td>
                        </tr>


                    </form>
                    

                </tbody>
            </table>

        </div>
        <div class="group-actions">
            <input type="hidden" name="create" value="yes">
            <input class="btn" type="submit" value="Cập nhật"> hoặc <a href="?opt=url">Hủy bỏ</a>
        </div>
    </div>

</form>

@endsection