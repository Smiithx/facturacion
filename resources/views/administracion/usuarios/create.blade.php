
@extends('administracion.index')
@section('administracion')

		      <div>
		      		                	<h3 class="text-center">Crear Usuarios</h3>

		      <div class="container-fluid">
		          <form action="/Usuarios" method="POST">
		          {!!csrf_field() !!}
		       <div class="form-group">
  <label for="nombre">Nombre:</label>
  <input type="text" class="form-control" id="nombre" name="nombre"  value="{{old('nombre')}}">
</div>
<div class="form-group">
  <label for="nit">Documento:</label>
  <input type="text" class="form-control" id="documento" name="documento"  value="{{old('documento')}}">
</div>

<div class="form-group">
  <label for="contraseña">Contraseña:</label>
  <input type="password" class="form-control" id="contraseña" name="contraseña"  value="{{old('contraseña')}}">
</div>

<div class="form-group">
  <label for="confirm_contraseña">Confirmar Contraseña:</label>
  <input type="password" class="form-control" id="confirm_contraseña" name="confirm_contraseña"  value="{{old('confirm_contraseña')}}">
</div>

<div class="form-group">
  <label for="firma">firma:</label>
  <input type="file" class="form-control" id="firma" name="firma"  value="{{old('firma')}}">
</div>
<div class="form-group">
  <label for="cargo">Cargo:</label>
 <select class="form-control" id="cargo"  name="cargo" >
            <option value="Medicos">Medicos</option>
            <option value="Enfermeras">Enfermeras</option>
            <option value="Otros">Otros</option>

        </select>
        
        </div>
		      
		     
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Crear Usuario</button>
		      </div>
		       </form>
 </div>
		    </div>@stop
		  