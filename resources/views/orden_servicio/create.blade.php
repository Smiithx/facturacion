@extends('layouts.layout')
@section('content')
<h3 class="text-center">Orden de servicio</h3>
<!-- formulario -->
<div class="container modal-header bg-info">
    <div class="row"> 
        <form method="POST" action="/ordenservicio">
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Documento:</label>
                <input type="text" class="form-control" id="orden-documento" name="documento"/>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Nombre:</label>  
                <input class="form-control" id="orden-nombre" type="text" name="nombre" value=""/>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Aseguradora:</label>
                <input class="form-control" id="orden-aseguradora" type="text" name="aseguradora" /> 
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Contrato:</label>
                <input class="form-control" id="orden-contrato" type="text" name="contrato" /> 
            </div>
            <br>
            <br>
            <table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_factura">
                <thead style="color: #fff;">
                    <tr> 
                        <th class="text-center">Cups</th>           
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Copago</th>
                        <th class="text-center">Valor unitario</th>
                        <th class="text-center">Valor total</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tfoot class="hidden" style="background: #f5f5f5;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center" style="vertical-align: middle;">TOTAL</td>
                        <td><input type="text" name="totalfactura" id="totalfactura" class="form-control" disabled></td>
                        <td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            <br>

            <br>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
                <input class="btn btn-primary pull-right" type="submit" id="facturar" onclick="agregafactura()" name="facturar" value="Facturar">
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection