@if(isset($meta_id_model))
   
    <?php 

    $metaSeo = App\Models\metaSeo::find($meta_id_model); ?>
  

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