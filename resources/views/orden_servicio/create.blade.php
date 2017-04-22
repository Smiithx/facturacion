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
                    <input type="text" class="form-control" id="orden-documento" name="documento"/>
                </div>
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Nombre:</label>  
                    <input readonly class="form-control" id="orden-nombre" type="text" name="nombre" value=""/>
                </div>
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Aseguradora:</label>
                    <input  readonly class="form-control" id="orden-aseguradora" type="text" name="aseguradora" /> 
                </div>
                <div class="form-group col-xs-12 col-md-3 col-lg-3">
                    <label for="label">Contrato:</label>
                    <input readonly  class="form-control" id="orden-contrato" type="text" name="contrato" /> 
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
                                <tbody>
                                    <tr>

                                        <td>
                                            <input type="text" name="cups"></td> 
                                        <td>
                                            <input type="text" name="descripcion" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="cantidad"></td> 
                                        <td>
                                            <input type="number" name="copago"></td>
                                        <td>
                                            <input type="number" name="valorunitario"></td>
                                        <td>
                                            <input type="number" name="valortotal"></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                        <hr>
                    </div>
                </div>
                <br>

                <br>
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    <input class="btn btn-primary pull-right" type="submit" id="facturar" onclick="agregafactura()" name="facturar" value="Facturar">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>
@endsection

