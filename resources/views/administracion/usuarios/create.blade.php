@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear usuario", "seccion" => "usuario"])

@endsection

@section('administracion')
    <div class="container-fluid">
        <form action="/usuarios" method="POST" enctype="multipart/form-data">
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
                <label for="confirm_contraseña">Confirmar contraseña:</label>
                <input type="password" class="form-control" id="confirm_contraseña" name="confirm_contraseña"  value="{{old('confirm_contraseña')}}">
            </div>
            <div class="form-group">
                <label for="firma">Firma:</label>
                <input type="file" class="form-control" id="firma" name="firma"  value="{{old('firma')}}">
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <select class="form-control" id="cargo"  name="cargo" >
                    <option value="Medicos" {{ old('cargo') == "Medicos" ? "selected" : ""}} >Medico</option>
                    <option value="Enfermeras" {{ old('cargo') == "Enfermeras" ? "selected" : ""}} >Enfermera</option>
                    <option value="Otros" {{ old('cargo') == "Otros" ? "selected" : ""}} >Otro</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Crear usuario</button>
            </div>
        </form>
    </div>
@stop
