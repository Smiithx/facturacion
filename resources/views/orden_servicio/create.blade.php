@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="container-fluid bg-white">
        <h3 class="text-center">Orden de servicio</h3>
        <hr>
        <!-- formulario -->

        <div class="container-fluid">

            <form  method="POST" action="/ordenservicio" name="frm_reg_ordendeservicios" >
                {{ csrf_field() }}
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Documento:</label>
                    <input type="text" class="form-control" id="orden-documento" name="documento" value="{{old('documento')}}"/>
                </div>
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Nombre:</label>  
                    <input readonly class="form-control" id="orden-nombre" type="text" name="nombre" value="{{old('nombre')}}"/>
                </div>
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Aseguradora:</label> 
                    <select readonly class="form-control" name="aseguradora_id" id="orden-aseguradora">
                        <option value="{{old('aseguradora_id')}}">{{old('aseguradora_id')}}</option>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Contrato:</label>
                    <input readonly  class="form-control" id="orden-contrato" type="text" name="contrato" value="{{old('contrato')}}"/>
                </div>
                <br>
                <br>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover"  id="tbl_factura">
                                <thead>
                                    <tr class="text-center"> 
                                        <th>Cups</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Copago</th>
                                        <th>Valor Unitario</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody id="orden_servicios_servicios">
                                    <tr>
                                        <td>
                                            <input type="text" name="cups" class="form-control orden_servicios_cups" value=""></td>
                                        <td> 
                                            <input type="text" name="descripcion" readonly class="form-control orden_servicios_descripcion" value="">
                                        </td>
                                        <td>
                                            <input type="number" name="cantidad" class="form-control orden_servicios_cantidad" value=""></td>
                                        <td>
                                            <input type="number" step="0.01" name="copago" class="form-control orden_servicios_copago" value=""></td>
                                        <td>
                                            <input type="number" step="0.01" name="valor_unitario" class="form-control orden_servicios_valor_unitario"></td>
                                        <td>
                                            <input type="number" step="0.01" name="valor_total" readonly class="form-control orden_servicios_valor_total"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-right">
                                            <button id="orden_servicios_añadir" class="btn btn-success glyphicon glyphicon-plus" type="button"></button>
                                            <button id="orden_servicios_eliminar" class="btn btn-danger glyphicon glyphicon-minus" type="button"></button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>   
                        <hr>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    <input class="btn btn-primary pull-right" type="submit" id="orden_servicios_crear" name="crear" value="Crear">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>
@endsection

