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

   <!--  <div class="btn btn-warning"><a href="{{ route('metaSeos.edit', 1) }}"></a>Seo</div> -->
    <div class="btn btn-warning"><a href="#mo-ta">Mô tả</a></div>
    <div class="btn btn-warning" ><a href="{{ route('filter-property') }}?group-product={{ $product->Group_id }}&productId={{ $product->id }}">Thông số</a></div>
    <div class="btn btn-warning"><a href="{{ route('images.create') }}?{{ $product->id }}">Ảnh</a></div>




    
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
