@extends('administracion.index')
@section('administracion')
                          <div>
                                                     <h3 class="text-center">Administrar Medicamentos</h3>

		                	<a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_medicamento()" data-placement="top" class="btn btn-primary pull-right">Nuevo</a>
		                	<br>
		                	<br>
		                	<table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_medicamentos">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">#</th>
		                				<th class="text-center">Descripción</th>
		                				<th class="text-center">Cum</th>
		                				<th class="text-center">Pos</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                </div>@stop