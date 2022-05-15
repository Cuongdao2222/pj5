@extends('layouts.app')

@section('content')

    @if(isset($product->Meta_id ))
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Product</h1>
                </div>
            </div>
        </div>
    </section>
     <?php $metaSeo = App\Models\metaSeo::find($product->Meta_id); ?>

     <?php

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

    ?>        

   <!--  <div class="btn btn-warning"><a href="{{ route('metaSeos.edit', 1) }}"></a>Seo</div> -->
   <div class="btn btn-warning" ><a href="{{ route('group-product-selected', $product->id) }}">Danh mục</a></div>
    <div class="btn btn-warning"><a href="#mo-ta">Mô tả</a></div>
    <div class="btn btn-warning" ><a href="{{ route('filter-property') }}?group-product={{ get_Group_Product($product->id)[0]??'' }}&productId={{ $product->id }}">Thông số</a></div>
    <div class="btn btn-warning"><a href="{{ route('images.create') }}?{{ $product->id }}">Ảnh</a></div>
    <div class="btn btn-warning" ><a href="#mo-ta">Thông số kỹ thuật chi tiết</a></div>
    <div class="btn btn-warning" ><a href="{{ route('details', $product->Link) }}" target="_blank">Xem tại web</a></div>

    

    
     @if(!empty($metaSeo))
    <div class="btn btn-info seo-click"> Dùng cho SEO </div>
   
    <div class="content px-3">

        
        @include('adminlte-templates::common.errors')

        <div class="card seo">

            {!! Form::model($metaSeo, ['route' => ['metaSeos.update', $metaSeo->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('meta_seos.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('metaSeos.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    @endif

    @endif

    <div class="content px-3">


        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

            <?php 

                if(!empty($product->Detail)){


                    $contens = $product->Detail;

                    $images = preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', $contens, $matches);

                }

                $ar_new = [];

                $ar_change = [];
                foreach ($matches[1] as $key => $value) {
                    str_replace('id="images'.$key., '', $contens);


                    $values = 'src="'.$value.'"';
                    $values1 = 'src="'.asset($value).'" id="images'.$key.'"';

                    $ar_new[] = $values;
                    $ar_change[] = $values1;
                   
                }
                $content1 = str_replace($ar_new, $ar_change, $contens);

                $product->Detail = $content1;
            ?>

           

            <div class="card-body">
                <div class="row">
                    @include('products.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
