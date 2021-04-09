<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="admin strana">
    <meta name="author" content="Boris Dmitrovic">

    <title>FC Ajax - @yield('title')</title>
@section('AppendCSS')
    <!-- Bootstrap core CSS -->
        <link href="{{asset ('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    @show
</head>

<body style="background-color: red;">
    @include('inc.nav')
    <div class="container" >

        <div class="row">

            <!-- Sadrzaj -->
            <div class="col-md-8">

            @yield('sadrzaj')


            <!--// Sadrzaj -->
            </div>
            @include('inc.adminDesno')
        </div>
    </div>

    @include('inc.futer')
</body>
    @section('appendJavascript')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @show
</html>

