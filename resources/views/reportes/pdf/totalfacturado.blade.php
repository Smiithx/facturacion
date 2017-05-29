@extends('reportes.pdf.layouts.plantilla')
@section("content")
<table class="table table-striped table-bordered table-hover" id="tabla_r1">
    <thead>
        <tr>

            <th class="text-center">N° de factura</th>
            <th class="text-center">Fecha expedición</th>
            <th class="text-center">Documento</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Valor total</th>

        </tr>
    </thead>
    <tbody>
        @foreach($facturas as $factura)
        <tr>
            <td class="text-center">{{ $factura->id_factura}}</td>
            <td class="text-center">{{ $factura->created_at}}</td>
            <td>{{ $factura->documento}}</td>
            <td>{{ $factura->nombre}}</td>
            <td class="text-right">{{ number_format($factura->factura_total,2)}} </td>
        </tr>
        @endforeach
    </tbody>
</table> 
@endsection