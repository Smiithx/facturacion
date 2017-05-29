@extends('reportes.pdf.layouts.plantilla')
@section("content")
<h3  class="text-center">reporte Total Facturado</h1>
<br>
<table class="table table-striped table-bordered table-hover" id="tabla_r1">
    <tbody>
        <tr>
            <td class="text-center">N° de factura</td>
            <td class="text-center">Fecha expedición</td>
            <td class="text-center">Documento</td>
            <td class="text-center">Nombre</td>
            <td class="text-center">Valor total</td>
        </tr>
   
      @foreach($facturas as $factura)
        <tr>
            <td class="text-center">{{ $factura->id_factura}}</td>
            <td class="text-center">{{ $factura->created_at}}</td>
            <td class="text-center">{{ $factura->documento}}</td>
            <td class="text-center">{{ $factura->nombre}}</td>
            <td class="text-center">{{ number_format($factura->factura_total,2)}} </td>
        </tr>
        @endforeach  


             <tr> 
             <td colspan="4">Total Facturado</td>       
            <td  >{{ $total_facturado }} </td>
        </tr>





    </tbody>
</table> 
@endsection