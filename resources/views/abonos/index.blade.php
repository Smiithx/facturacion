@extends('layouts.layout')
@section('content')
<h3 class="text-center">Abonos</h3>
<hr>
<div class="form-group col-xs-12 col-md-3 col-lg-3">
    <label for="label">Factura:</label>
    <input class="form-control" placeholder="Escribir Factura" id="abonos_factura" type="text" name="abonos_factura"/>
</div>
<div class="form-group col-xs-12 col-md-1">
    <label for=""></label>
    <button class="btn btn-success" id="btn_abonos_buscar" type="button">Buscar</button>
</div>
<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped  table-hover" id="tbl_abonos">
                <thead>
                    <tr>      
                        <th>Factura</th>
                        <th>Descripcion</th>
                        <th>Valor Abono</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="abonos_tbody">              
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr>
<script src="{{asset('assets/js/abonos.js')}}"></script>

@endsection