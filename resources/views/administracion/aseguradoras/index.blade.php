@extends('administracion.index')
@section('administracion')
  <div>
		            	
		                	<h3 class="text-center">Aseguradoras</h3>
		                	<a title="Agregar" data-toggle="modal" data-target="#modalaseguradora"  data-placement="top" class="btn btn-primary pull-right aseguradoras">Nuevo</a>
		                	<br><br>
		                	
		                	@if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
		                	<br>
		                	<table class="table table-striped table-bordered table-hover table-responsive" id="tabla_aseguradoras">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">NIT</th>
		                				<th class="text-center">Estado</th>
		                				<th class="text-center">Acciones</th>

		                		</tr>
		                			
		                		</thead>
		                		
                     
		                		
		                		<tbody>
		                			
		                	@foreach($aseguradoras as $aseguradora)
		                			<tr>
		             <td>{{ $aseguradora->nombre }}</td>
                    <td>{{ $aseguradora->nit }}</td>
                    <td>{{ $aseguradora->estado }}</td>
                    <td>    <a style="float: left;" href="/administracion/aseguradoras/{{$aseguradora->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['Aseguradora.destroy', $aseguradora->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
		                			</tr>
		                			@endforeach
		                			
		                		</tbody>
		                			<tfoot>
		                		<td colspan="4" style="text-align: center;">
		                			{!! $aseguradoras->render()!!}
</td>
		                		</tfoot>
		                	</table>
		                	<br>
		                </div>
<!-- MODAL ASEGURADORA -->


	<div class="modal fade" tabindex="-1" id="modalaseguradora" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Agregar Aseguradora</h4>
		       
		      </div>
		      <div class="modal-body">
		      <div class="container-fluid">
		          <form action="/Aseguradora" method="POST">
		          {!!csrf_field() !!}
		       <div class="form-group">
  <label for="nombre">Nombre:</label>
  <input type="text" class="form-control" id="nombre" name="nombre" required value="{{old('nombre')}}">
</div>
<div class="form-group">
  <label for="nit">Nit:</label>
  <input type="text" class="form-control" id="nit" name="nit" required value="{{old('nit')}}">
</div>
<div class="form-group">
  <label for="estado">Estado:</label>
 <select class="form-control" id="estado"  name="estado" >
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select>
        
        </div>
		      
		     
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Crear Aseguradora</button>
		      </div>
		       </form>
 </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div>

<!-- /Fin modal Aseguradora-->
		                 @stop
