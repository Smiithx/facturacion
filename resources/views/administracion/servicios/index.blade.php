@extends('administracion.index')
@section('administracion')
                     <div>
		                <a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_tipservicio()" data-placement="top" class="btn btn-primary pull-right">Nuevo</a>
		                <br>
		                <br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tablacitas">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">Cups</th>
		                				<th class="text-center">Costo Asmet</th>
		                				<th class="text-center">Costo SURA</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                </div> @stop