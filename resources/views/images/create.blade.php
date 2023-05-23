@extends('layouts.app')

@section('content')

    <style type="text/css">
        .btn-show{
            width: 100%;
        }
        .fixed{
            position: fixed;
            top:58px;
            z-index: 999;
            background: green;
        }
    </style>

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

            if(!empty($result[0]) && $result[0]==8){
                $data_groupProduct = App\Models\groupProduct::where('level', 2)->get()->pluck('id');

                if(isset($data_groupProduct)){

                    $result = [];

                    $infoProductOfGroup = App\Models\groupProduct::select('product_id', 'id')->whereIn('id', $data_groupProduct)->get()->toArray();

                    if(isset($infoProductOfGroup)){

                        foreach($infoProductOfGroup as $key => $val){


                            if(!empty($val['product_id'])&& in_array($id, json_decode($val['product_id']))){

                                array_push($result, $val['id']);
                            }
                           
                            
                        }

                    }
                }


            }

            return $result;

        }

        $group_id = get_Group_Product($product_id);
        $product_info = App\Models\product::find($product_id);


    ?>
    <div class="btn-show">
        <div class="btn btn-warning" ><a href="{{ route('products.edit', $product_id) }}">Cơ bản</a></div>

        <div class="btn btn-warning" ><a href="{{ route('group-product-selected', $product_id) }}">Danh mục</a></div>
         <div class="btn btn-warning btn-info seo-click"><a href="{{ route('products.edit', $product_id) }}?seo=$product_id">SEO</a></div>

        <div class="btn btn-warning"><a href="{{ route('products.edit', $product_id) }}?mota={{ $product_id }}">Mô tả</a></div>
        <div class="btn btn-warning" ><a href="{{ route('filter-property') }}?group-product={{ get_Group_Product($product_id)[0]??'' }}&productId={{ $product_id }}">Thông số</a></div>
        <div class="btn btn-warning activess"><a href="{{ route('images.create') }}?{{ $product_id }}">Ảnh</a></div>
        <div class="btn btn-warning" ><a href="{{ route('details',  $product_info->Link) }}" target="_blank">Xem tại web</a></div>
    </div>   
   
    <div class="content px-3">



        @include('adminlte-templates::common.errors')

        <?php 
            $imageProduct = (App\Models\product::find($product_id))->Image;
        ?>

        @if(!empty($imageProduct))

        <h3>ảnh đại diện đang được chọn</h3>
        <div class="">
            <img src="{{ asset($imageProduct) }}" style="width: 10%;">
        </div>
        <br>
        @endif
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
                <th>Chọn ảnh đại diện</th>
                <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
                    <td><img src="{{ asset($image->image) }}" height="150px" width="150px"></td>

                
                <td>{{ $image->product_id }}</td>
                <td>
                    <input type="checkbox" class="show-image-product"  name="check" value="{{ $image->image }}"  {{ $image->image==$imageProduct?'checked':'' }}>
                </td>
                <td>  <input type="checkbox" class="active-image" id="active-image-{{ $image->id }}" data-id="{{ $image->id }}"  name="check" value="{{ $image->image }}"  {{ $image->active===1?'checked':'' }}> </td>

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

    @push('page_scripts')

    <script type="text/javascript">

         
        $('.show-image-product').on('change', function() {
           $('.show-image-product').not(this).prop('checked', false);

            $.ajax({
                type: 'GET',
                url: "{{ route('image-ajax-product') }}",
                data: {
                    product_id: '{{ $product_id }}',
                    image:$(this).val()
                },
                success: function(result){

                     location.reload();
                }
            });
           
        });

        $('.active-image').on('change', function() {

            id = $(this).attr('data-id');



            if($('#active-image-' + id).is(":checked")){

               active = 1;
                
            }
            else{
                active = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: "{{ route('check-active-image') }}",
                data: {
                    id: id,
                    active:active
                },
                success: function(result){
                     location.reload();
                }
            });

        });    

        height_check = $('.btn-show').offset().top;

        $(window).scroll(function (){

            if($(window).scrollTop() > height_check){

                $('.btn-show').addClass('fixed');
            }
            else{
                $('.btn-show').removeClass('fixed');
            }

        });    

    </script>

    @endpush
@endsection
