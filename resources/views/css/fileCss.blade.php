@extends('layouts.app')

@push('page_scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('lined-textarea/jquery-linedtextarea.css') }}">
<script src="{{ asset('lined-textarea/jquery-linedtextarea.js') }}"></script>

 <style type="text/css">
        
        .main-header{
            position: static !important;
        }

        textarea {
            outline: none;
        }
        textarea {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }

        textarea:focus {
            outline: none;
        }

    </style>
@endpush

@section('content')
    <?php 
        $page = ['homecs.css', 'categorycs.css', 'detailscs.css'];
    ?>
    File {{ $page[$id] }}
    <form method="post" action="{{ route('saveCss') }}">
        @csrf
         <button type="submit">Lưu lại</button>

          <br>

        <input type="hidden" name="file" value="{{ $page[$id] }}">  

        <textarea style="width: 800px; height: 1900px;" name="css" class="lined">{!!  $contents  !!}</textarea>

         <br>
       
       
    </form>

     <script type="text/javascript">
        $(function() {
            $(".lined").linedtextarea();
        });
    </script>
    
@endsection

