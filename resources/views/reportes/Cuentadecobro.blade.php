@extends('reportes.index')
@section('reportes') <!-- Inicia reporte 5 -->
<div class="col-sm-12">
     <h3 class="text-center">Cuenta de cobro</h3>

            <div class="form-group col-xs-12 col-md-3 col-lg-3">
             <label for="label">Factura:</label>  
             <input class="form-control"  placeholder="Escibir Factura " id="cxc_factura" type="text" name="id_factura"/>
            </div>
          
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha desde:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="cxc_desde" type="text" name="cxc_desde"
                       required  placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha hasta:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="cxc_hasta" type="text" name="cxc_hasta"
                       required placeholder="yyyy-mm-dd"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-1">
            <label for="">&nbsp</label>
            <button class="btn btn-success" id="btn_cxc_buscar" type="button">Buscar</button>
        </div>
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r4">
        <thead style="color:#fff; background: #3b5998;">
            <tr>

                <th class="text-center">Nº de orden</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Cups</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Copago</th>
                <th class="text-center">Valor unitario</th>
            </tr>
        </thead>
                        <tbody id="cxc_tbody">

        </tbody>
    </table>    <br>
      <div class="form-group col-xs-12 col-md-12 col-lg-12">
                        <input class="btn btn-primary pull-right" type="submit" id="cxc"  name="cxc" value="Guardar">
                    </div>
</div>

@stop
            <script src="{{asset('assets/js/cxc.js')}}"></script>

<!-- Termina reporte 5 -->