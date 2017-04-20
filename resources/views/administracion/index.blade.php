@extends('layouts.layout')
@section('content')

<div class="" >
		    <div class="container-fluid">
		    <div  class="col-sm-12">
		        <h3 class="text-center">Ajustes</h3>
		        
		        <div class="col-xs-3">
		            <!-- required for floating -->
		            <!-- Nav tabs -->
		            <ul class="nav nav-tabs tabs-left">
		                <li class="active link"><a href="#datose" data-toggle="tab">Datos de la empresa</a></li>
		                <li class="link"><a href="#usuarios" data-toggle="tab">Usuarios</a></li>
		                <li class="link"><a href="#tipocita" data-toggle="tab">Tipos de Servicios</a></li>
		                <li class="link"><a href="#aseguradoras" data-toggle="tab">Aseguradoras y contratos</a></li>
		                <li class="link"><a href="#manuales" data-toggle="tab">Manuales</a></li>
		                
		            </ul>
		        </div>
		        <div class="col-xs-9">
		            <!-- Tab panes -->
		            <div class="tab-content">
		                <div class="tab-pane active" id="datose">
		                	<form method="POST" action="">
		                		<div class="form-group">
		                			<label>Razón social</label>
		                			<input type="text" name="razon" id="razon" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>NIT</label>
		                			<input type="text" name="nit" id="nit" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>Representante legal</label>
		                			<input type="text" name="representante" id="representante" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>Dirección</label>
		                			<input type="text" name="direccion" id="direccion" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>Teléfono</label>
		                			<input type="text" name="telefono" id="telefono" class="form-control">
		                		</div>
		                		<div class="form-group">
		                			<label>Logo</label>
		                			<div class="input-group">
						                <input type="text" class="form-control" name="image" id="image" value="">
						                    <span class="input-group-btn">
						                      <button type="button" class="btn btn-info btn-flat" id="logo" data-toggle="modal" data-target="#modaledit"><i class="fa fa-camera"></i></button>
						                    </span>
						                    
						            </div>
		                		</div>
		                		
		                		<div class="form-group">
		                			<button type="button" onclick="guarda_dg()" class="btn btn-primary pull-right">Guardar</button>
		                		</div>
		                	</form>
		                </div>
		                 <div class="tab-pane" id="usuarios">
		                	<a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_usuario()" data-placement="top" class="btn btn-primary pull-right aseguradoras">Nuevo</a>
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
		                <div class="tab-pane" id="tipservicio">
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
		                </div>
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
		                				<th class="text-center">Acción</th>
		                			</tr>
		                	@foreach($aseguradoras as $aseguradora)
		                			<tr>
		             <td>{{ $aseguradora->nombre }}</td>
                    <td>{{ $aseguradora->nit }}</td>
                    <td>{{ $aseguradora->estado }}</td>
		                			</tr>
		                			@endforeach
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                	<br>
		                </div>
		                <div class="tab-pane" id="diagnosticos">
		                	<a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_diagnostico()" data-placement="top" class="btn btn-primary pull-right">Nuevo</a>
		                	<br>
		                	<br>
		                	<table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_diagnosticos">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">Código</th>
		                				<th class="text-center">Descripción</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                </div>
		                <div class="tab-pane" id="medicamentos">
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
		                </div>
		                <div class="tab-pane" id="procedimientos">
		                	<a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_procedimiento()" data-placement="top" class="btn btn-primary pull-right">Nuevo</a>
		                	<br>
		                	<br>
		                	<table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_procedimientos">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">#</th>
		                				<th class="text-center">Cups</th>
		                				<th class="text-center">Descripción</th>
		                				<th class="text-center">Pos</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                </div>
		                <div class="tab-pane" id="manuales">
		                	<a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_manual()" data-placement="top" class="btn btn-primary pull-right">Nuevo</a>
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
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                </div>
		                <div class="tab-pane" id="plantillas">
		                	<a title="Agregar" data-toggle="modal" data-target="#modaledit" onclick="add_plantilla()" data-placement="top" class="btn btn-primary pull-right">Nuevo</a>
		                	<br>
		                	<br>
		                	<table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_plantillas">
		                		<thead style="color:#fff; background: #3b5998;">
		                			<tr>
		                				<th class="text-center">#</th>
		                				<th class="text-center">Nombre</th>
		                				<th class="text-center">Contenido</th>
		                				<th class="text-center">Acción</th>
		                			</tr>
		                		</thead>
		                		<tbody>
		                			
		                		</tbody>
		                	</table>
		                </div>
		            </div>
		        </div>
		        <div class="clearfix"></div>
		    </div>
    		</div>
		</div>
		<br>
		<div class="modal fade" tabindex="-1" id="modaledit" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Modificar asegu</h4>
		      </div>
		      <div class="modal-body">
		        
		      </div>
		      <div class="modal-footer">
		        
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
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
  <input type="text" class="form-control" id="nombre" name="nombre">
</div>
<div class="form-group">
  <label for="nit">Nit:</label>
  <input type="text" class="form-control" id="nit" name="nit">
</div>
<div class="form-group">
  <label for="estado">Estado:</label>
 <select class="form-control" id="estado"  name="estado">
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

		<div class="modal fade" tabindex="-1" id="modalupload" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">subir imagen</h4>
		      </div>
		      <div class="modal-body">
		      
		      </div>
		      <div class="modal-footer">
		        
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


@endsection