@extends('layouts.front')

@section('title')
    Glaerija
@endsection
@section('AppendCSS')
    @parent
   <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/lightbox.min.css" >
@endsection

@section('sadrzaj')
    @include('inc.galerijaSlike')
@endsection
@section('appendJavascript')
    @parent
<script type="text/javascript"src="{{asset('/')}}js/lightbox-plus-jquery.min.js"></script>
@endsection