   @extends('administracion.index')
@section('administracion')
                         <div>
		                	<a title="Agregar" href="/administracion/usuarios/create"  class="btn btn-primary pull-right usuarios">Nuevo</a>
		                	<br>
		                	<br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tabla_usuarios">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">Documento</th>
		                				<th class="text-center">Cargo</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                 </div>
		                 
		                
		                 @stop