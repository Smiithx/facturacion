@extends('layouts.layout')
@section('content')

<h3 class="text-left">Reportes</h3>
<br>

<!-- opciones -->
<div class="col-sm-12">
  <a   class="btn btn-primary btn-lg" href="reportes/totalfacturado">Total facturado</a>

   <a   class="btn btn-primary btn-lg" href="reportes/Ordenesporfacturar">Ordenes por facturar</a>
    <a   class="btn btn-primary btn-lg" href="reportes/Atencionesrealizadas">Atenciones realizadas</a>
     <a   class="btn btn-primary btn-lg" href="reportes/Imprimirfactura">Imprimir factura</a>
      <a   class="btn btn-primary btn-lg" href="reportes/Cuentadecobro">Cuenta de Cobro</a>

   </div>

   <div class="col-sm-12" style="margin-top: 20px;">
       

@yield('reportes')    


   </div>
<!-- fin opciones -->




@endsection