@extends('administracion.index')
@section('administracion')
                     <div>
                     @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                <a title="Agregar" href="/administracion/servicios/create"  class="btn btn-primary pull-right servicios">Nuevo</a>
		                <br>
		                <br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tablacitas">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Cups</th>
		                				<th class="text-center">Descripcion</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                						
		                	@foreach($servicios as $servicio)
		                			<tr>
		             <td>{{ $servicio->cups }}</td>
                    <td>{{ $servicio->descripcion }}</td>
                    <td>{{ $servicio->estado }}</td>
                    <td>    <a href="/administracion/servicios/{{$servicio->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['Servicios.destroy', $servicio->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
		                			</tr>
		                			@endforeach

		                		</tbody>
		                	</table>
		                </div> @stop