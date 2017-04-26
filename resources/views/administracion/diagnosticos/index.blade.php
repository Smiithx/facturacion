@extends('administracion.index')
@section('administracion')  <div>
                           <h3 class="text-center">Administrar Diagnosticos</h3>

                     @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                <a title="Agregar" href="/administracion/diagnosticos/create"  class="btn btn-primary pull-right diagnosticos">Nuevo</a>
		                <br>
		                <br>
		                	<table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_diagnosticos">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Código</th>
		                				<th class="text-center">Descripción</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			@foreach($diagnosticos as $diagnostico)
		                			<tr>
		             <td>{{ $diagnostico->codigo }}</td>
                    <td>{{ $diagnostico->descripcion }}</td>
                    <td>{{ $diagnostico->estado }}</td>
                    <td>    <a style="float: left;" href="/administracion/diagnosticos/{{$diagnostico->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['Diagnosticos.destroy', $diagnostico->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
		                			</tr>
		                			@endforeach
		                			
		                			
		                			
		                		</tbody>
		                		<tfoot>
		                		<td colspan="4" style="text-align: center;">
		                			{!! $diagnosticos->render()!!}
</td>
		                		</tfoot>
		                	</table>
		                </div>@stop