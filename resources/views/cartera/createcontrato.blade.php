@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Cartera</h3>
    <hr>
    <form method="POST" action="/cartera">
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Contrato:</label>
            <input class="form-control" placeholder="Escribir Contrato" id="cartera_factura" type="text"
                   name="id_factura"/>
        </div>
     
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha desde:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="cartera_desde" type="text" name="cartera_desde"
                       required placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha hasta:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="cartera_hasta" type="text" name="cartera_hasta"
                       required placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-1">
            <label for=""></label>
            <button class="btn btn-success" id="btn_cartera_buscar" type="button">Buscar</button>
        </div>
        <br>
        <br>
        <table class="table table-striped table-bordered table-hover table-responsive "
               style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_cartera">
            <thead style="color: #fff;">
            <tr>
                <th class="text-center">Factura</th>
                <th class="text-center">Fecha Radicación</th>
                <th class="text-center">Valor Factura</th>
                <th class="text-center">Fecha de Vencimiento</th>
                <th class="text-center">Valor Abono</th>
                <th class="text-center">Valor Glosa</th>
                <th class="text-center">Retención</th>
                <th class="text-center">Saldo</th>
            </tr>
            </thead>
            <tbody id="cartera_tbody">

            </tbody>
        </table>
        <br>
        <div class="form-group col-xs-12 col-md-12 col-lg-12">
            <input class="btn btn-primary pull-right" type="submit" id="radicar" onclick="agregafactura()"
                   name="cartera" value="Guardar">
        </div>
        {{csrf_field()}}
    </form>
   <script src="{{asset('assets/js/cartera.js')}}"></script>

@endsection