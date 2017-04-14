@extends('layouts.layout')
@section('content')

	<form method="POST" action="/cartera">
			  	<div class="form-group col-xs-12 col-md-3 col-lg-3">
		            	<label for="label">Factura:</label>  
		            	<input class="form-control" id="factura" type="text" name="factura" value=""/>
		          	</div>
				  	<div class="form-group col-xs-12 col-md-3 col-lg-3">
		            	<label for="label">Contrato:</label>
		             	<input type="text" class="form-control" id="contrato" name="contrato"/>
		           	</div>
		          	
		          	<div class="form-group col-xs-12 col-md-3 col-lg-3">
		            	<label for="label">Fecha desde:</label>  
		            	<input class="form-control" id="fdesde" type="text" name="fdesde" value=""/>
		          	</div>
		          	<div class="form-group col-xs-12 col-md-3 col-lg-3">
		            	<label for="label">Fecha hasta:</label>
		             	<input class="form-control" id="fhasta" type="text" name="fhasta" /> 
		          	</div>
		          
		          	<br>
		          	<br>
		          	<table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_factura">
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
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    	<input class="btn btn-primary pull-right" type="submit" id="radicar" onclick="agregafactura()" name="radicar" value="Radicar">
                    </div>
                    {{csrf_field()}}
				</form>

@endsection