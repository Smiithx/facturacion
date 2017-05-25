@extends('reportes.index')
@section('menu')

    @include('reportes.partials.menu',["pagina" => "Atenciones realizadas", "seccion" => "atenciones realizadas"])

@stop

@section('reportes')
    <!-- Inicia reporte 3 -->
    <div class="row">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input type='text' name="fecha_inicio" id="fecha_inicio" class="form-control"
                       placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input type='text' name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-1">
            <label></label>
            <button type="button" id="resulta_r2" class="btn btn-success">Buscar
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_r3">
            <thead>
            <tr>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">CUPS</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Diagnostico 1</th>
                <th class="text-center">Diagnostico 2</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" href="/reportes/Atencionesrealizadas/pdf" target="_blank">Imprimir</a>
    </div>
    <!-- Termina reporte 3 -->@stop