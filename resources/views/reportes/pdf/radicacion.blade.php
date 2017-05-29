@extends('reportes.pdf.layouts.plantilla')
@section("content")
   <table class="table table-striped table-bordered table-hover" >
            <thead>
            <tr>
                <th class="text-center">Factura #</th>
                <th class="text-center">Valor Factura</th>
                <th class="text-center">Fecha</th>

            </tr>
            </thead>
            <tbody id="radicacion_tbody">
              @foreach($facturasradicadas as $factura)
        <tr>
            <td class="text-center">{{ $factura->id}}</td>
            <td class="text-center">{{ number_format($factura->factura_total,2)}} </td>
            <td class="text-center">{{ $factura->fecha_radicacion}}</td>
         
        </tr>
        @endforeach  
        

            </tbody>
        </table>
@endsection
