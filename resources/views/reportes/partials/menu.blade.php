<hr>
<!-- opciones -->
<ul class="nav nav-pills">
    <li role="presentation" class="{{ $seccion == 'total facturado' ? 'active' : ''}}"><a href="/reportes/totalfacturado">Total facturado</a></li>

    <li role="presentation" class="{{ $seccion == 'ordenes por facturar' ? 'active' : ''}}"><a href="/reportes/Ordenesporfacturar">Ordenes por facturar</a></li>

    <li role="presentation" class="{{ $seccion == 'atenciones realizadas' ? 'active' : ''}}"><a href="/reportes/Atencionesrealizadas">Atenciones realizadas</a></li>

    <li role="presentation" class="{{ $seccion == 'imprimir factura' ? 'active' : ''}}"><a href="/reportes/Imprimirfactura">Imprimir factura</a></li>

    <li role="presentation" class="{{ $seccion == 'cuenta de cobro' ? 'active' : ''}}"><a href="/reportes/Cuentadecobro">Cuenta de Cobro</a></li>
    
    <li role="presentation" class="{{ $seccion == 'facturas radicadas' ? 'active' : ''}}"><a href="/reportes/radicacion">Facturas Radicadas</a></li>
</ul>
<hr>
<h2 class="text-center">{{$pagina}}</h2>
<hr>
<!-- fin opciones -->