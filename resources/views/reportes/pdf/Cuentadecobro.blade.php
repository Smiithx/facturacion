@extends('reportes.pdf.layouts.plantilla')
@section("content")
     <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">Nº de Factura</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Documento</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Cups</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Copago</th>
            <th class="text-center">Valor unitario</th>
            <th class="text-center">Valor Total</th>


        </tr>
                </thead>
        <tbody id="cxc_tbody">
              @foreach($facturas as $factura)

     <tr>
        <td class="text-center"></td>
            <td class="text-center">{{ $factura->id}}</td>
            <td class="text-center">{{ $factura->documento}}</td>
            <td class="text-center">{{ $factura->nombre}}</td>
            <td class="text-center">{{ $factura->cups}}</td>
            <td class="text-center">{{ $factura->descripcion}}</td>
            <td class="text-center">{{ number_format($factura->valor_unitario,2)}}</td>
            <td class="text-center">{{ number_format($factura->valor_total,2)}}</td>
            <td class="text-center">{{ number_format($factura->valor_total,2)}}</td>
            </tr>
                    @endforeach  


        </tbody>
        <tfoot>

        <tr>
            <th colspan="8" class="text-right">Total</th>
            <th class="text-right" colspan="1" id="total_facturado_cxc">{{ number_format($total_facturado_cxc,2)}}</th>
        </tr>
        <tr>
            <th colspan="8" class="text-right">Saldo Pendiente</th>
            <th class="text-right" colspan="1" id="saldo_cxc">{{ number_format($factura->valor_saldo,2)}}</th>
        </tr>

        </tfoot>
    </table>
@endsection
