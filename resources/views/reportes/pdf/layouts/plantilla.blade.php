<html>
<head>
    <link rel="stylesheet" href="{{asset('assets/css/pdf.css')}}">
    <title>@section('title') @show</title>
</head>
<body>
<div class="container-fluid">
    <!--   inicio del Header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="logo">
                    <img src="/imagenes/{{$empresa->file}}" alt="{{$empresa->file}}" class="img-responsive">
                </div>
                <div class="datos">
                    <h1>{{$empresa->rezon_social}}</h1>
                    <p>{{$empresa->direccion}}</p>
                    <p>NIF: {{$empresa->nit}}</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </header>
    <!--  /Header -->
    <!--   inicio del cuerpo-->
    <div class="container-fluid">
        @yield('content')
    </div>
    <!-- /cuerpo -->
    <!--  <footer> -->

    <!-- </footer> -->
</div>
</body>
</html>

  

