@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Crear Cartera</h3>
    <hr>
    <form method="POST" action="/cartera">
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Contrato:</label>
           
            <select class="form-control" name="cartera_factura" id="cartera_contrato">
                @foreach ($contratos as $contrato)
                <option value="{{$contrato->id}}">{{$contrato->nombre}}</option>
                @endforeach
            </select>

                   
          <input class="form-control" id="cartera_factura" type="hidden" value="0" name="id_contrato"/>
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