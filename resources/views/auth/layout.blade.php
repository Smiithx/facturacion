<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>
<body>
<br><br>
<!-- formulario -->
@yield('content')
<!-- /formulario -->

<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/js/login.js')}}"></script>
@yield('scripts')
</body>
</html>