@extends('administracion.index')
@section('administracion')
                     <div>
                                                <h3 class="text-center">Administrar Contratos</h3>

                     @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                <a title="Agregar" href="/administracion/Contratos/create"  class="btn btn-primary pull-right servicios">Nuevo</a>
		                <br>
		                <br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tablacitas">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Contrato</th>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">Nit</th>
		                				<th class="text-center">Dias Venci.</th>
		                				<th class="text-center">Manual Tarif.</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Acciones</th>


		                			</tr>
		                		</thead>
		                		<tbody>
		                					
  		                	

		                		</tbody>
		                	</table>
		                </div> @stop