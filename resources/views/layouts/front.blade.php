<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="strana za korisnike">
    <meta name="author" content="Boris Dmitrovic">

    <title>FC Ajax - @yield('title')</title>
    @section('AppendCSS')
    <!-- Bootstrap core CSS -->

    <link href="{{asset('/')}}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/')}}css/blog-home.css" rel="stylesheet">
    @show
</head>

<body>

@include('inc.nav')
<div class="container">

    <div class="row">

        <!-- Sadrzaj -->
        <div class="col-md-8" style="margin-top:40px;">
            
        @yield('sadrzaj')


        <!--// Sadrzaj -->
        </div>
        @include('inc.desna')
    </div>
</div>


@include('inc.futer')

@section('appendJavascript')
<!-- Bootstrap core JavaScript -->
<script src="{{asset('/')}}vendor/jquery/jquery.min.js"></script>
<script src="{{asset('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('/')}}js/jquery.js"></script>
<script type="text/javascript" src="{{ asset('/')}}js/home.js"></script>
<script type="text/javascript">
    const baseUrl = '{{url('/')}}';
    const csrf = '{{csrf_token()}}';
</script>

@show
</body>

</html>
