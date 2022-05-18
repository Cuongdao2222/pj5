@extends('layouts.app')

@section('content')

<style type="text/css">
    
    .btn-red{
        background: yellow;
    }
</style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Search form -->
                    
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('products.create') }}">
                        Add New
                    </a>
                </div>

                <div class="btn btn-red"><a href="{{ route('deal') }}">deal sản phẩm</a></div>

                <div class="bthongbao"></div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('products.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $products])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

