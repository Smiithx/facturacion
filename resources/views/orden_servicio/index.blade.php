@extends('layouts.layout')
@section('content')
<h3 class="text-center">Ordenes de servicio</h3>
<hr>
<div class="form-group col-xs-12 col-md-5">
    <label for="orden_servicio_factura">N° de factura:</label>
    <input class="form-control" id="orden_servicio_factura" type="text" name="factura"
           value="{{old('factura')}}"/>
</div>
<div class="form-group col-xs-12 col-md-5">
    <label for="orden_servicio_documento">Documento:</label>
    <input readonly type="text" class="form-control" id="orden_servicio_documento" name="documento"
           value="{{old('documento')}}"/>
</div>
<div class="form-group col-xs-12 col-md-1">
    <label for=""></label>
    <button class="btn btn-default" id="orden_servicio_buscar" type="button">Buscar</button>
</div>
<br>
<br>
<div class="col-xs-12">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="tbl_factura">
            <thead>
                <tr class="text-center">
                    <th class="text-center">N° Orden</th>
                    <th class="text-center">Paciente</th>
                    <th class="text-center">Documento</th>
                    <th class="text-center">Aseguradora</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody id="orden_servicio_tbody">
                <tr>
                    <td class='text-center'>
                        <a href='' target='_blank'></a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='text-right'></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total:</th>
                    <th class="text-right" colspan="1" id="orden_servicio_total"></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>
</div>
<script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>
@endsection

