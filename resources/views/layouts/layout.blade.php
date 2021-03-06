<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Web</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datepicker/bootstrap-datepicker3.css')}}">
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/js/localization/messages_es.js')}}"></script>
    <script src="{{asset('assets/js/jquery.number.js')}}"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
</head>
<body>
<header class="modal-header text-success text-center bg-success">
    <h1>Registro de Usuarios</h1>
</header>
<!-- menu -->
@include('layouts.menu')
<br>
@if (count($errors) > 0)
    <div class="container">
        @include('partials.errors')
    </div>
@endif
<div class="container">
    @include('flash::message')
</div>
@if (session('status'))
    <div class="container">
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    </div>
@endif
<!-- /menu -->
<!-- formulario -->
<div class="container modal-header bg-info">
    <div class="row">
        <div class="container-fluid">
            <div class="container-fluid bg-white">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>
<!-- /formulario -->
@yield('scripts')
</body>
</html>