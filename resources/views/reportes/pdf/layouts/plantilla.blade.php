<html>
<head>
<link rel="stylesheet" href="{{asset('assets/css/pdf.css')}}">
   
</head>

<body>
<!--   inicio del Header -->  

  <header>
    <p>{{$empresa->rezon_social}}</p>
    <p>Nit: {{$empresa->nit}}</p>
    <p>Direccion: {{$empresa->direccion}}</p>
    <img src="/imagenes/{{$empresa->file}}" alt="{{$empresa->file}}" class="img-responsive" id="logo">

  </header>
 
<body>


<!--   inicio del footer -->  

 <!--  <footer>
   
  </footer>--> 
  
  @yield('plantilla')    

  

