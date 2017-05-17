@extends('layouts.layout')
@section('content')
<h3 class="text-center">Glosas</h3>
    <hr>
    <form method="POST" action="/glosas">
			<div class="form-group col-xs-12 col-md-3 col-lg-3">
		     <label for="label">Factura:</label>  
		     <input class="form-control"  placeholder="Escibir Factura " id="glosas_factura" type="text" name="id_factura"/>

          <input class="form-control" id="glosas_contrato" type="hidden" value="0" name="id_contrato"/>

		    </div>
		  
        <div class="form-group col-xs-12 col-md-1">
            <label for=""></label>
            <button class="btn btn-success" id="btn_glosas_buscar" type="button">Buscar</button>
        </div>
			
		          
		          	<br>
		          	<br>	
		         <table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_glosas">
                 <thead style="color: #fff;">
	                        <tr> 
	                        <th class="text-center">Factura</th>           
	                          <th class="text-center">Fecha Radicación</th>	                                               
	                          <th class="text-center">Valor Factura</th>
	                          <th class="text-center">Valor Glosa</th>
	                          <th class="text-center">Valor Aceptado</th>	                      
	                          
	                        </tr>
                      	</thead>

                      	<tbody id="glosas_tbody">

                      	</tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    	<input class="btn btn-primary pull-right" type="submit" id="glosas"  name="glosar" value="Guardar">
                    </div>
                   {{csrf_field()}}
    </form>
             
		    <script src="{{asset('assets/js/glosas.js')}}"></script>
	
@endsection