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
                <input type='text' name="fecha_inicio" id="fecha_inicio_atenciones_realizadas" class="form-control"
                       placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input type='text' name="fecha_fin" id="fecha_fin_atenciones_realizadas" class="form-control" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-1">
            <label></label>
            <button type="button" id="btn_buscar_atenciones_realizadas" class="btn btn-success">Buscar
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_r3">
            <thead>
            <tr>
               <th class="text-center">#</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">CUPS</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Status</th>
            </tr>
            </thead>
            <tbody id="tbody_atenciones_realizadas">

            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" href="/reportes/Atencionesrealizadas/pdf" id="btn_atenciones_imprimir" target="_blank">Imprimir</a>
    </div>
    <!-- Termina reporte 3 -->
    <script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>

    @stop