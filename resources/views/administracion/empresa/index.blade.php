@extends('adminitracion.index')
@section('administracion')
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
		                @stop