@extends('layouts.layout')
@section('content')

<h3 class="text-center">Reportes</h3>
<hr>

<!-- opciones -->
<ul class="nav nav-pills">
    <li role="presentation" class="active"><a href="/reportes/totalfacturado">Total facturado</a></li>
    <li role="presentation"><a href="/reportes/Ordenesporfacturar">Ordenes por facturar</a></li>
    <li role="presentation"><a href="/reportes/Atencionesrealizadas">Atenciones realizadas</a></li>
    <li role="presentation"><a href="/reportes/Imprimirfactura">Imprimir factura</a></li>
    <li role="presentation"><a href="/reportes/Cuentadecobro">Cuenta de Cobro</a></li>
    <li role="presentation"><a href="/reportes/radicacion">Facturas Radicadas</a></li>


</ul>
<!-- fin opciones -->

<div class="col-xs-12" style="margin-top: 20px;">
    @yield('reportes')    
</div>

@endsection