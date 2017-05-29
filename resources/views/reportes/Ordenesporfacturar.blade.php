@extends('reportes.index')
@section('menu')

    @include('reportes.partials.menu',["pagina" => "Ordenes por facturar", "seccion" => "ordenes por facturar"])

@stop

@section('reportes')
    <!-- Inicia reporte 2 -->
    <div class="row">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input required type='text' name="fecha_inicio" id="fecha_inicio_ordenes_facturar" class="form-control"
                       placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input required type='text' name="fecha_fin" id="fecha_fin_ordenes_facturar" class="form-control"
                       placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-1">
            <label></label>
            <button id="btn_ordenes_facturar_buscar" class="btn btn-success ">
                Buscar
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_r2">
            <thead>
            <tr>
                <th class="text-center">N° de Orden</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody id="tbody_ordenes_facturar">

            </tbody>
        </table>
    </div>
    <div class="modal-footer">
    <a class="btn btn-primary" href="/reportes/Ordenesporfacturar/pdf" target="_blank" id="btn_ordenes_por_facturar_imprimir">Imprimir</a>
    </div>
    <script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>

@stop
<!-- Termina reporte 2 -->