@extends('reportes.index')

@section('menu')

    @include('reportes.partials.menu',["pagina" => "Total facturado", "seccion" => "total facturado"])

@stop

@section('reportes')
    <!-- Inicia reporte 1 -->

    <div class="row">
        <div class="form-group col-md-3">
            <label>Aseguradora</label>
            <select class="form-control aseguradora" name="totalfacturado_aseguradora" id="totalfacturado_aseguradora">
                @foreach ($aseguradoras as $aseguradora)
                    <option value="{{$aseguradora->id}}">{{$aseguradora->nombre}}</option>
                @endforeach
                <option value="all">Todas</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Contrato</label>
            <select class="form-control contrato" name="totalfacturado_contrato" id="totalfacturado_contrato">
                @foreach ($contratos as $contrato)
                    <option value="{{$contrato->id}}">{{$contrato->nombre}}</option>
                @endforeach
                <option value="all">Todos</option>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input type='text' name="totalfacturado_fecha_inicio" id="totalfacturado_fecha_inicio"
                       class="form-control" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input type='text' name="totalfacturado_fecha_fin" id="totalfacturado_fecha_fin" class="form-control"
                       placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-1">
            <label></label>
            <button type="button" id="btn_totalfacturado_buscar"
                    class="btn btn-success">Buscar
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_r1">
            <thead>
            <tr>
                <th class="text-center">N° de factura</th>
                <th class="text-center">Fecha expedición</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Valor total</th>

            </tr>
            </thead>
            <tbody id="totalfacturado_tbody">
            </tbody>
            <tfoot>
            <tr>
                <th class="text-right" colspan="4">Total</th>
                <th class="text-right" colspan="1" id="total_facturado"></th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" href="/reportes/totalfacturado/pdf/" target="_blank" id="btn_totalfacturado_imprimir">Imprimir</a>
    </div>
    <script src="{{asset('assets/js/factura.js')}}"></script>

@stop
<!-- Termina reporte 1 -->