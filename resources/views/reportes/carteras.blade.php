@extends('reportes.index')
@section('reportes') <!-- Inicia reporte 5 -->
<div class="col-sm-12">
     <h3 class="text-center">cartera</h3>

            <div class="form-group col-xs-12 col-md-3 col-lg-3">
             <label for="label">Factura</label>  
             <input class="form-control"  placeholder="Escibir Factura" id="cartera_factura" type="text" name="id_factura"/>
            </div>
          
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha desde:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="cartera_desde" type="text" name="cartera_desde"
                       required  placeholder="yyyy-mm-dd"/>
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
            <label for="">&nbsp</label>
            <button class="btn btn-success" id="btn_cartera_reporte_buscar" type="button">Buscar</button>
        </div>
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r4">
        <thead style="color:#fff; background: #3b5998;">
            <tr>

                <th class="text-center">Nº Factura</th>
                <th class="text-center">Valor cartera</th>
                <th class="text-center">Valor Aceptado</th> 
                                         <th class="text-center">Fecha</th> 

                          
                <th class="text-center">Accion</th>

            </tr>
        </thead>
                        <tbody id="cartera_tbody">

        </tbody>
    
    </table>    <br>
<div class="form-group col-xs-12 text-right">
        <a href="/reportes" class="btn btn-success">Regresar</a>
        <button class="btn btn-primary hidden" id="reporte_factura_btn_imprimir">Imprimir</button>
    </div>
</div>
            <script src="{{asset('assets/js/cartera.js')}}"></script>

@stop

<!-- Termina reporte 5 -->