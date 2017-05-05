@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Radicar contrato</h3>
    <hr>
    <form method="POST" action="/radicacion">
        <div class="form-group col-xs-12 col-md-2">
            <label for="label">Contrato:</label>
            <input type="text" class="form-control" id="radicacion_contrato" name="contrato"/>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha desde:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicaciopn_contrato_desde" type="text" name="desde"
                       required value="{{old('radicaciopn_contrato_desde')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha hasta:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicaciopn_contrato_hasta" type="text" name="hasta"
                       required value="{{old('radicaciopn_contrato_hasta')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha de Radicacion:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicacion_contrato_fecha" type="text" name="fecha_radicacion"
                       disabled
                       required value="{{old('fecha_radicacion')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-1">
            <label for=""></label>
            <button class="btn btn-success" id="radicacion_contrato_buscar">Buscar</button>
        </div>
        <br>
        <br>
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Contrato</th>
                        <th>Fecha</th>
                        <th>Valor total</th>
                        <th>Radicar</th>
                    </tr>
                    </thead>
                    <tbody id="radicacion_factura_tbody">
                    <tr>
                        <td class="text-center"><a href=""></a></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="form-group col-xs-12 col-md-12 col-lg-12">
            <input class="btn btn-primary pull-right" type="submit" id="radicar" onclick="agregafactura()"
                   name="radicar" value="Radicar">
        </div>
        {{csrf_field()}}
    </form>

@endsection