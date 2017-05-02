@extends('layouts.layout')
@section('content')
<h3 class="text-center">Factura de Venta</h3>
<!-- formulario -->
<div class="container modal-header bg-info">
    <div class="row"> 
        <form method="POST" action="/facturas">
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Contrato:</label>
                <input  type="text" class="form-control" id="facturar_contrato" name="facturar_contrato"/>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Desde:</label>  
                <div class='input-group date datepicker' id='datetimepicker1'>
                <input  type='text' name="facturar_fecha_desde" id="facturar_fecha_desde" class="form-control" placeholder="Desde"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            </div>

     


            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Hasta:</label>
                <div class='input-group date datepicker' id='datetimepicker1'>
                <input  type='text' name="facturar_fecha_hasta" id="facturar_fecha_hasta" class="form-control" placeholder="Hasta"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            </div>

            <div class="form-group col-xs-12 col-md-3 col-lg-3">
             <label for="buscar">&nbsp</label>
            <input type="button" name="btn_facturar_buscar" value="Buscar" class="input-group btn btn-success" id="btn_facturar_buscar">

            

        </div>

          
            <table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_factura">
                <thead style="color: #fff;">
                    <tr> 

                        <th class="text-center">Cups</th>           
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Valor Unitario</th>
                        <th class="text-center">Copago</th>	                          
                        <th class="text-center">Valor total</th>
                        <th class="text-center"><input name='checkbox[]' type='checkbox' id='cbox1'  value=''></th>
                    </tr>
                </thead>
               
                <tbody id="facturar_tbody">


                </tbody>

            </table>
            
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
                <input class="btn btn-primary pull-right" type="submit" id="facturar" onclick="agregafactura()" name="facturar" value="Facturar">
            </div>
            {{ csrf_field()}}
        </form>
    </div>
</div>

 <script src="{{asset('assets/js/factura.js')}}"></script>
@endsection

