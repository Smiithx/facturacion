@extends('layouts.layout')
@section('content')
<h3 class="text-center">Orden de servicio # {{ $ordenservicio->id }} </h3>
<hr>
<div class="col-xs-12 col-md-2">
    <label for="label">Documento:</label>
    <input readonly type="text" class="form-control" id="orden-documento" name="documento"
           value="{{ $ordenservicio->documento }}"/>
</div>
<div class="col-xs-12 col-md-3 col-lg-3">
    <label for="label">Nombre:</label>
    <input readonly class="form-control" id="orden-nombre" type="text" name="nombre"
           value="{{ $ordenservicio->nombre }}"/>
</div>
<div class="col-xs-12 col-md-3 col-lg-3">
    <label for="label">Aseguradora:</label>
    <input type="text" readonly class="form-control" name="aseguradora_id" id="orden-aseguradora"
           value="{{ $ordenservicio->aseguradora_id->nombre }}">

</div>
<div class="col-xs-12 col-md-2">
    <label for="label">Contrato:</label>
    <input readonly class="form-control" id="orden-contrato" type="text" name="contrato"
           value="{{ $ordenservicio->id_contrato->nombre }}"/>
</div>
<div class="col-xs-12 col-md-2">
    <label for="label">N° de factura:</label>
    <input readonly class="form-control text-right" type="text"
           value="{{ $factura ? $factura : "" }}"/>
</div>
<div class="clearfix"></div>
<hr>
<div class="col-xs-12">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="tbl_factura">
            <thead>
                <tr class="text-center">
                    <th>Cups</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Copago</th>
                    <th>Valor Unitario</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody id="orden_servicios_servicios">
                @foreach($OrdenServicio_Items as $OrdenServicio_Item)
                <tr>
                    <td>{{ $OrdenServicio_Item->cups }}</td>
                    <td>{{ $OrdenServicio_Item->descripcion }}</td>
                    <td class="text-right">{{ number_format($OrdenServicio_Item->cantidad,2) }}</td>
                    <td class="text-right">{{ number_format($OrdenServicio_Item->copago,2) }}</td>
                    <td class="text-right">{{ number_format($OrdenServicio_Item->valor_unitario,2) }}</td>
                    <td class="text-right">{{ number_format($OrdenServicio_Item->valor_total,2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total: </th>
                    <th class="text-right">{{ number_format($ordenservicio->orden_total,2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="modal-footer">
    <a href='/ordenservicio/$ordenservicio->id/anular' class='btn btn-danger' data-toggle='tooltip' title='Anular'>Anular</a>
    <a   class="btn btn-default " href="javascript:window.close()" data-toggle='tooltip' title='Regresar'>Regresar</a>
</div>
@endsection

