<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consultas Web</title>
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
        <script src="{{asset('assets/js/jquery.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
        <script src="{{asset('assets/js/index.js')}}"></script>
        <script src="{{asset('assets/js/datepicker-es.js')}}"></script>
    </head>
    <body>
        <header class="modal-header text-success text-center bg-success">   
            <h1 class="text-success">Registro de Usuarios</h1>     
        </header>
        <!-- menu -->
        @include('layouts.menu')
        <br>
        @if (count($errors) > 0)
        <div class="container">
            @include('partials.errors')
        </div>
        @endif

        <!-- /menu -->
        <!-- formulario -->
        <div class="container modal-header bg-info">
            <div class="row"> 
                @yield('content')
            </div>
        </div>
        
        <br><br>
        <!-- /formulario -->
    
    </body>
</html>