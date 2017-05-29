@extends('reportes.pdf.layouts.plantilla')
@section("content")

<h3>Reporte Factura</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="text-center">N° Factura</th>
            <th class="text-center">Documento</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Aseguradora</th>
            <th class="text-center">Contrato</th>
            <th class="text-center">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center"> {{$factura->id}}</td>
            <td class="text-center"> {{$factura->id}}</td>
            <td class="text-center"> {{$factura->id}}</td>
            <td class="text-center"> {{$factura->id}}</td>
            <td class="text-center"> {{$factura->id}}</td>
            <td class="text-center"> {{$factura->factura_total}}</td>
        </tr>
        </tbody>
    </table>
</div>
@endsection