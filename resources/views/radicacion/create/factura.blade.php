@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Radicar factura</h3>
    <hr>
    <form method="POST" action="/radicacion">
        <div class="form-group col-xs-12 col-md-6">
            <label for="label">Factura:</label>
            <input type="text" class="form-control" id="radicacion_factura" name="id_factura"
                   placeholder="Numero de factura" required value="{{old('id_factura')}}"/>
            <input type="hidden" name="factura" required id="radicacion_factura_id">
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label for="label">Fecha de radicación:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="radicacion_fecha_radicacion" type="text" name="fecha_radicacion"  disabled
                       required value="{{old('fecha_radicacion')}}" placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
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
            <input class="btn btn-primary pull-right" type="submit" name="radicar" value="Radicar">
        </div>
        {{csrf_field()}}
    </form>
    <script src="{{asset('assets/js/radicacion.js')}}"></script>
@endsection