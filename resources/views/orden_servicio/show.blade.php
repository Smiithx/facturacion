@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Orden de servicio</h3>
    <hr>
    {{ csrf_field() }}
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Documento:</label>
        <input readonly type="text" class="form-control" id="orden-documento" name="documento"
               value="{{ $ordenservicio->documento }}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Nombre:</label>
        <input readonly class="form-control" id="orden-nombre" type="text" name="nombre"
               value="{{ $ordenservicio->nombre }}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Aseguradora:</label>
        <input type="text" readonly class="form-control" name="aseguradora_id" id="orden-aseguradora"
               value="{{ $ordenservicio->aseguradora_id->nombre }}">

    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Contrato:</label>
        <input readonly class="form-control" id="orden-contrato" type="text" name="contrato"
               value="{{ $ordenservicio->contrato }}"/>
    </div>
    <br>
    <br>
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
                        <td>{{ number_format($OrdenServicio_Item->cantidad,2) }}</td>
                        <td>{{ number_format($OrdenServicio_Item->copago,2) }}</td>
                        <td>{{ number_format($OrdenServicio_Item->valor_unitario,2) }}</td>
                        <td>{{ number_format($OrdenServicio_Item->valor_total,2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <hr>
    </div>
@endsection

