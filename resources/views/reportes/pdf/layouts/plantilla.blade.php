<html>
<head>
<link rel="stylesheet" href="{{asset('assets/css/pdf.css')}}">
   
</head>

<body>
<!--   inicio del Header -->  

  <header>
    <h1>Cabecera de mi documento dentro de pdf - reportes</h1>
    <h2>DesarrolloWeb.com</h2>
  </header>
 
<body>
  <header>
    <h1>Cabecera de mi documento</h1>
    <h2>DesarrolloWeb.com</h2>
  </header>

<!--   inicio del footer -->  

 <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              Desarrolloweb.com
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  
  @yield('plantilla')    

  

