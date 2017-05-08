@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Radicar contrato</h3>
    <hr>
    <form method="POST" action="/radicacion/contrato">
        <div class="form-group col-xs-12 col-md-2">
            <label for="label">Contrato:</label>
            <input type="text" class="form-control" id="radicacion_contrato" name="contrato" value="{{old('contrato')}}"/>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha desde:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicaciopn_contrato_desde" type="text" name="desde"
                       required value="{{old('desde')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha hasta:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicaciopn_contrato_hasta" type="text" name="hasta"
                       required value="{{old('hasta')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha de Radicacion:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicacion_contrato_fecha" type="text" name="fecha_radicacion"
                       disabled required value="{{old('fecha_radicacion')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-1">
            <label for=""></label>
            <button class="btn btn-default" id="radicacion_contrato_buscar" type="button">Buscar</button>
        </div>
        <br>
        <br>
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">N° Factura</th>
                        <th class="text-center">Contrato</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Valor total</th>
                        <th class="text-center">
                            <input type="checkbox" name="all" id="radicacion_contrato_all">
                        </th>
                    </tr>
                    </thead>
                    <tbody id="radicacion_contrato_tbody">
                    <tr>
                        <td class="text-center"><a href=""></a></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-right" colspan="4">Total</th>
                        <th class="text-right" colspan="1" id="radicacion_contrato_total"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <div class="form-group col-xs-12 col-md-12 col-lg-12">
            <input class="btn btn-primary pull-right" type="submit" id="radicar"
                   name="radicar" value="Radicar">
        </div>
        {{csrf_field()}}
    </form>
    <script src="{{asset('assets/js/radicacion.js')}}"></script>
@endsection