   @extends('administracion.index')
@section('administracion')
                         <div>
                           <h3 class="text-center">Administrar Usuario</h3>
                         @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                	<a title="Agregar" href="/administracion/usuarios/create"  class="btn btn-primary pull-right usuarios">Nuevo</a>
		                	<br>
		                	<br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tabla_usuarios">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">Documento</th>
		                				<th class="text-center">Firma</th>
		                				<th class="text-center">Cargo</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                	@foreach($usuarios as $usuario)
		                			<tr>
		             <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->documento }}</td>
                    <td>{{ $usuario->firma }}</td>
                    <td>{{ $usuario->cargo }}</td>

                    <td>    <a href="/administracion/usuarios/{{$usuario->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['Usuarios.destroy', $usuario->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
		                			</tr>
		                			@endforeach

		                			
		                		</tbody>
		                	</table>
		                 </div>
		                 
		                
		                 @stop