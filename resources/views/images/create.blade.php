@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Image</h1>
                </div>
            </div>
        </div>
    </section>

    
    <?php  
        $start = stripos($_SERVER['REQUEST_URI'],'?');
        
        $result = substr($_SERVER['REQUEST_URI'], $start);

        $product_id = str_replace('?', '', $result);

        function get_Group_Product($id){
            $data_groupProduct = App\Models\groupProduct::where('level', 0)->get()->pluck('id');

            $infoProductOfGroup = App\Models\groupProduct::select('product_id', 'id')->whereIn('id', $data_groupProduct)->get()->toArray();

            $result = [];


            if(isset($infoProductOfGroup)){

                foreach($infoProductOfGroup as $key => $val){


                    if(!empty($val['product_id'])&& in_array($id, json_decode($val['product_id']))){

                        array_push($result, $val['id']);
                    }
                   
                    
                }

            }

            
            return $result;

        }

        $group_id = get_Group_Product($product_id);
        $product_info = App\Models\product::find($product_id);

    ?>

    <div class="btn btn-warning" ><a href="{{ route('group-product-selected', $product_id) }}">Danh mục</a></div>
    <div class="btn btn-warning"><a href="{{ route('products.edit', $product_id) }}#mo-ta">Mô tả</a></div>
    <div class="btn btn-warning" ><a href="{{ route('filter-property') }}?group-product={{  $group_id[0]??'' }}&productId={{ $product_id }}">Thông số</a></div>
    <div class="btn btn-warning"><a href="{{ route('images.create') }}?{{ $product_id }}">Ảnh</a></div>
    <div class="btn btn-warning" ><a href="{{ route('products.edit', $product_id) }}#mo-ta">Thông số kỹ thuật chi tiết</a></div>
   
    <div class="btn btn-warning" ><a href="{{ route('details', $product_info->Link) }}" target="_blank">Xem tại web</a></div>




    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'images.store', 'files' => true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('images.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('images.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <?php 


        $images = App\Models\image::where('product_id', $product_id)->get();
       
    ?>


    @if(!empty($images))

    <div class="table-responsive">
        <table class="table" id="images-table">
            <thead>
            <tr>
                <th>Image</th>
            
            <th>Product Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
                    <td><img src="{{ asset($image->image) }}" height="150px" width="150px"></td>
                
                <td>{{ $image->product_id }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['images.destroy', $image->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('images.show', [$image->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('images.edit', [$image->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div><a href="{{ route('products.index') }}">Quay về trang sản phẩm</a></div>
    @endif
@endsection
