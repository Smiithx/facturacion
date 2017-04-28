@extends('administracion.index')
@section('administracion')
                     <div>
                                                <h3 class="text-center">Administrar Contratos</h3>

                     @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                <a title="Agregar" href="/administracion/contratos/create"  class="btn btn-primary pull-right servicios">Nuevo</a>
		                <br>
		                <br>
		                	<table class="table table-striped table-bordered table-hover table-responsive">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Contrato</th>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">Nit</th>
		                				<th class="text-center">Dias Venci.</th>
		                				<th class="text-center">Manual Tarif.</th>	                				
		                				<th class="text-center">Porcentaje</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Acciones</th>


		                			</tr>
		                		</thead>
		                		<tbody>

		                		@foreach($contratos as $contrato)
		                			<tr>
		               <td>{{ $contrato->contrato }}</td>
		             <td>{{ $contrato->nombre }}</td>
                    <td>{{ $contrato->nit}}</td>
                    <td>{{ $contrato->diasvencimiento }}</td>
                    <td>{{ $contrato->codigosoat }}</td>
                      <td>{{ $contrato->porcentaje }}</td>
                    <td>{{ $contrato->estado }}</td>
                    <td> 
                       <a style="float: left;" href="/administracion/contratos/{{$contrato->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i></a>

                        {!! Form::open(['route' => ['Contratos.destroy', $contrato->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
		                			</tr>
		                			@endforeach

		                					
  		                	

		                		</tbody>
		                	</table>
		                </div> @stop