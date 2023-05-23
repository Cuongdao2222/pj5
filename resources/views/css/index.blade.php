@extends('layouts.app')

@section('content')

    <style type="text/css">
        .position{
            position: inherit;
        }
    </style>

    <h2>Danh sách file css có thể sửa</h2>
    
    <a href="{{ route('readCss', 0) }}">home.css</a>
    <br>
    <a href="{{ route('readCss', 1) }}">category.css</a>
    <br>
    <a href="{{ route('readCss', 2) }}">details.css</a>

@endsection

