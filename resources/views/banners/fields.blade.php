@if(Route::currentRouteName()=="banners.create")
<?php 
    $option[0] = ['name'=>'Banner slide home', 'size'=>'1920px x 630px'];
    $option[1] = ['name'=>'Banner top', 'size'=>'1920px x 44px'];
    $option[2] = ['name'=>'Banner bên phải slider home', 'size'=>'254px x 254px'];
    $option[3] = ['name'=>'Banner dưới slider home', 'size'=>'690px x 305px'];
    $option[4] = ['name'=>'Banner category', 'size'=>'1200 x 200px'];
    $option[5] = ['name'=>'Banner trên phần sale home', 'size'=>'1200 x 90'];

?>
<div class="form-group col-sm-12">
<select name="option">
    @foreach($option as $key => $options)
    <option value="{{ $key }}">{{ $options['name'] }}</option>
 
    @endforeach
</select>
@endif
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('image', ['class' => 'custom-file-input']) !!}
            {!! Form::label('image', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>


<!-- slogan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slogan', 'Slogan:') !!}
    {!! Form::text('slogan', null, ['class' => 'form-control']) !!}
</div>

<!-- stt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stt', 'STT:') !!}
    {!! Form::text('stt', null, ['class' => 'form-control']) !!}
</div>



<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>