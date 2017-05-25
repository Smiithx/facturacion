@extends('reportes.index')
@section('menu')

    @include('reportes.partials.menu',["pagina" => "Imprimir factura", "seccion" => "imprimir factura"])

@stop

@section('reportes') <!-- Inicia reporte 4 -->
<div class="row">
    <div class="form-group col-md-3">
        <label>Fecha inicio:</label>
        <div class='input-group date datepicker' id='datetimepicker1'>
            <input type='text' name="imprimirfactura_fecha_inicio" id="imprimirfactura_fecha_desde" class="form-control" placeholder="Fecha inicio"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Fecha fin:</label>
        <div class='input-group date datepicker' id='datetimepicker2'>
            <input type='text' name="imprimirfactura_fecha_fin" id="imprimirfactura_fecha_hasta" class="form-control" placeholder="Fecha fin"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group col-md-1">
        <label></label>
        <button type="button" id="btn_imprimirfactura_buscar" name="btn_imprimirfactura_buscar" class="btn btn-success">Buscar</button>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabla_r4">
        <thead>
        <tr>
            <th class="text-center">N° de Orden</th>
            <th class="text-center">Documento</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Aseguradora</th>
            <th class="text-center">Contrato</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Acciones</th>
        </tr>
        </thead>
        <tbody id="imprimirfactura_tbody">

        </tbody>
    </table>
</div>
<div class="modal-footer">
    <a class="btn btn-primary" href="/reportes/Imprimirfactura/pdf" target="_blank">Imprimir</a>
</div>
    <script src="{{asset('assets/js/factura.js')}}"></script>

@stop
<!-- Termina reporte 4 -->