@extends('administracion.index')
@section('administracion')
                         <div>
                                 <h3 class="text-center">Administrar Manuales</h3>

                     @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                <a title="Agregar" href="/administracion/manuales/create"  class="btn btn-primary pull-right servicios">Nuevo</a>
		                <br>
		                <br>
		                	<table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_manuales">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">#</th>
		                				<th class="text-center">Tipo de manual</th>
		                				<th class="text-center">Cups</th>
		                				<th class="text-center">Código soat</th>
		                				<th class="text-center">Costo</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                			@foreach($manuales as $manuale)
		                			<tr>
		               <td>{{ $manuale->id }}</td>
		             <td>{{ $manuale->tipomanual }}</td>
                    <td>{{ $manuale->servicios_id}}</td>
                    <td>{{ $manuale->codigosoat }}</td>
                    <td>{{ $manuale->costo }}</td>
                    <td>{{ $manuale->estado }}</td>
                    <td> 
                       <a style="float: left;" href="/administracion/manuales/{{$manuale->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i></a>

                        {!! Form::open(['route' => ['Manuales.destroy', $manuale->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
		                			</tr>
		                			@endforeach

		                		</tbody>
		                	</table>
		                </div>@stop