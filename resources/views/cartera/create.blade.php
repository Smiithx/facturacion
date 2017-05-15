@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Cartera</h3>
    <hr>
    <form method="POST" action="/cartera">
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Factura:</label>
            <input class="form-control" placeholder="Escribir Factura" id="cartera_factura" type="text"
                   name="cartera_factura"/>
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
     <div class="col-xs-12">
            <div class="row">
 <div class="table-responsive">
                    <table class="table table-striped  table-hover" id="tbl_cartera">
                  

            <thead>
            <tr>
                <th>Factura</th>
                <th>Fecha Radicación</th>
                <th>Valor Factura</th>
                <th>Fecha de Vencimiento</th>
                <th>Valor Abono</th>
                <th>Valor Glosa</th>
                <th>Retención</th>
                <th>Saldo</th>
            </tr>
            </thead>


    
            <tbody id="cartera_tbody">

            </tbody>
       
        </table>
        </div>
        </div></div>
           <hr>

        <div class="form-group col-xs-12 col-md-12 col-lg-12">
            <input class="btn btn-primary pull-right" type="submit" id="radicar" 
                   name="cartera" value="Guardar">
        </div>
        {{csrf_field()}}
    </form>
    <script src="{{asset('assets/js/cartera.js')}}"></script>

@endsection