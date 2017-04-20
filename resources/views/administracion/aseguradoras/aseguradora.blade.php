
  <div class="tab-pane" id="aseguradoras">
		            	
		                	<h3 class="text-center">Aseguradoras</h3>
		                	<a title="Agregar" data-toggle="modal" data-target="#modalaseguradora"  data-placement="top" class="btn btn-primary pull-right aseguradoras">Nuevo</a>
		                	<br>
		                	<br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tabla_aseguradoras">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">NIT</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Accion</th>

		                			
		                		</thead>
		                		<tbody>
		                			</tr>
		                	@foreach($aseguradoras as $aseguradora)
		                			<tr>
		             <td>{{ $aseguradora->nombre }}</td>
                    <td>{{ $aseguradora->nit }}</td>
                    <td>{{ $aseguradora->estado }}</td>
                    <td>Editar</td>
		                			</tr>
		                			@endforeach
		                			<tr><td colspan="4">
		                			{!! $aseguradoras->render()!!}</td></tr>
		                		</tbody>
		                	</table>
		                	<br>
		                </div>
		       