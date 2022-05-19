@extends('layouts.app')

@section('content')
@if(isset($id))
    <form method="POST" action="{{ route('imagecontents') }}" enctype="multipart/form-data" accept-charset="UTF-8">
        @csrf
        <div class="card-body">
            <div class="row">
                <!-- Image Field -->
                <div class="form-group col-sm-6">
                    <label for="image">Image:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input class="" multiple="" name="image[]" type="file">
                            
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-6" style="display:none">
                    <label for="product_id">Product_id:</label>
                    <input class="form-control" name="product_id" type="text" value="{{ $id }}" id="product_id">
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">save</button>
    </form>

@endif
@endsection