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