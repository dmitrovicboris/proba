@extends('layouts.front')

@section('title')
    Igrači
@endsection
@section('sadrzaj')
@include('inc.listaIgraca')


@endsection
{{--@section('appendJavascript')--}}
    {{--@parent--}}
    {{--<script type="text/javascript" src="{{ asset('/')}}js/home.js"></script>--}}
{{--@endsection--}}