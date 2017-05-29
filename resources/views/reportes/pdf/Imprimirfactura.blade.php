@extends('reportes.pdf.layouts.plantilla')
@section("title")
Factura {{$factura->id}}
@endsection
@section("content")
    <table class="table">
        <thead>
        <tr>
            <th>N° Factura</th>
            <th>{{$factura->id}}</th>
            <th>Contrato</th>
            <th>{{$factura->id_contrato->nombre}}</th>
            <th>Fecha</th>
            <th>{{$factura->created_at}}</th>
        </tr>
        </thead>
    </table>
    <div class="clearfix"></div>
    <table class="table">
        <thead>
        <tr>
            <th class="text-center">Cups</th>
            <th class="text-center">Descripcion</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Valor unitario</th>
            <th class="text-center">Copago</th>
            <th class="text-center">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td class="text-center">{{$item->cups}}</td>
                <td>{{$item->descripcion}}</td>
                <td class="text-center"> {{$item->cantidad}}</td>
                <td class="text-right"> {{$item->valor_unitario}}</td>
                <td class="text-right"> {{$item->copago}}</td>
                <td class="text-right"> {{number_format($item->valor_total,2)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tbody>
        <tr>
            <th class="text-right" colspan="5">Total</th>
            <th class="text-right">{{number_format($factura->factura_total,2)}}</th>
        </tr>
        </tbody>
    </table>
@endsection