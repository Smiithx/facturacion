@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Facturar</h3>
    <hr>
    <form method="POST" action="/facturas">
        <div class="row form-group">
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Contrato:</label>
                <input type="text" class="form-control" id="facturar_contrato" name="facturar_contrato"/>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Desde:</label>
                <div class='input-group date datepicker' id='datetimepicker1'>
                    <input type='text' name="facturar_fecha_desde" id="facturar_fecha_desde" class="form-control"
                           placeholder="Desde"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Hasta:</label>
                <div class='input-group date datepicker' id='datetimepicker1'>
                    <input type='text' name="facturar_fecha_hasta" id="facturar_fecha_hasta" class="form-control"
                           placeholder="Hasta"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="buscar">&nbsp</label>
                <input type="button" name="btn_facturar_buscar" value="Buscar" class="input-group btn btn-success"
                       id="btn_facturar_buscar">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Paciente</th>
                            <th class="text-center">Documento</th>
                            <th class="text-center">Aseguradora</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Total</th>
                            <th class="text-center"><input name='all' type='checkbox' id='facturar_all'>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="facturar_tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12 col-lg-12">
            <input class="btn btn-primary pull-right" type="submit" id="facturar" name="facturar" value="Facturar">
        </div>
        {{ csrf_field()}}
    </form>
    <script src="{{asset('assets/js/factura.js')}}"></script>
@endsection

