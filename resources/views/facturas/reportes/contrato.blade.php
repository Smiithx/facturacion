@extends('layouts.layout')
@section('content')

<h3 class="text-center">Reporte de facturas por contrato</h3>
<hr>

<div class="row form-group">
    <div class="form-group col-xs-12 col-md-4">
        <label for="label">Contrato:</label>
        <select name="id_contrato" id="reporte_factura_contrato_id_contrato" class="form-control">
            <option value="">Seleccione un contrato</option>
            @foreach ($contratos as $contrato)
            <option value="{{$contrato->id}}" {{old('id_contrato') == $contrato->id ? "selected":""}}>{{$contrato->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3">
        <label for="label">Fecha desde:</label>
        <div class="input-group date datepicker">
            <input class="form-control" id="reporte_factura_contrato_desde" type="text" name="desde"
                   value="{{old('desde')}}" placeholder="yyyy-mm-dd"/>
            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
    </div>
    <div class="form-group col-xs-12 col-md-3">
        <label for="label">Fecha hasta:</label>
        <div class="input-group date datepicker">
            <input class="form-control" id="reporte_factura_contrato_hasta" type="text" name="hasta"
                   value="{{old('hasta')}}" placeholder="yyyy-mm-dd"/>
            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
    </div>
    <div class="form-group col-xs-12 col-md-1">
        <label for=""></label>
        <button class="btn btn-default" id="reporte_factura_contrato_buscar" type="button">Buscar</button>
    </div>
</div>
<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">N° Factura</th>
                        <th class="text-center">Fecha de facturacion</th>
                        <th class="text-center">Fecha de radicacíon</th>
                        <th class="text-center">Valor total</th>
                    </tr>
                </thead>
                <tbody id="reporte_factura_contrato_tbody">
                    <tr>
                        <td class='text-center'><a href='' target='_blank'></a></td>
                        <td class='text-center'></td>
                        <td class='text-center'></td>
                        <td class='text-right'></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                        <th class="text-right" colspan="1" id="reporte_factura_contrato_total"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="form-group col-xs-12 text-right">
    <a href="/facturas" class="btn btn-success">Regresar</a>
    <button class="btn btn-primary hidden" id="reporte_factura_btn_imprimir">Imprimir</button>
</div>
<script src="{{asset('assets/js/factura.js')}}"></script>
@endsection

