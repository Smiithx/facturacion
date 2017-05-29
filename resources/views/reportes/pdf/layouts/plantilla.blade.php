<html>
<head>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pdf.css')}}">
</head>
<body>
<div class="container">
    <!--   inicio del Header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="logo">
                    <img src="/imagenes/{{$empresa->file}}" alt="{{$empresa->file}}" class="img-responsive"
                         id="logo">
                </div>
                <div class="datos">
                    <h1>{{$empresa->rezon_social}}</h1>
                    <p>{{$empresa->direccion}}</p>
                    <p>NIF: {{$empresa->nit}}</p>
                </div>
            </div>
        </div>
    </header>
    <!--  /Header -->
    <!--   inicio del cuerpo-->
@yield('content')
<!-- /cuerpo -->
    <!--  <footer> -->

    <!-- </footer> -->
</div>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
</body>
</html>

  

