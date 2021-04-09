@extends('layouts.front')

@section('title')
    Početna
@endsection
@section('sadrzaj')
    @empty(!session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endempty
    @include('inc.post')
@endsection
