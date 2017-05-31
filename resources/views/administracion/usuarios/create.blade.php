@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear usuario", "seccion" => "usuario"])

@endsection

@section('administracion')
    <div class="container-fluid">
        <form action="{{route("usuarios.store")}}" method="POST">
            {!!csrf_field() !!}
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input required type="text" class="form-control" id="nombre" name="name"  value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="nit">Documento:</label>
                <input required type="text" class="form-control" id="documento" name="documento"  value="{{old('documento')}}">
            </div>
            <div class="form-group">
                <label for="nit">Correo:</label>
                <input required type="email" class="form-control" id="email" name="email"  value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input required type="password" class="form-control" id="password" name="password" minlength="6" value="{{old('contraseña')}}">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña:</label>
                <input required type="password" class="form-control" id="password_confirmation" name="password_confirmation"  value="{{old('password_confirm')}}">
            </div>
            <div class="form-group">
                <label for="firma">Firma:</label>
                <input type="file" class="form-control" id="firma" name="firma" value="{{old('firma')}}">
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <select required class="form-control" id="cargo"  name="cargo" >
                    <option value="medico" {{ old('cargo') == "admin" ? "selected" : ""}} >Administrador</option>
                    <option value="enfermera" {{ old('cargo') == "enfermera" ? "selected" : ""}} >Enfermera</option>
                    <option value="medico" {{ old('cargo') == "medico" ? "selected" : ""}} >Medico</option>
                    <option value="otro" {{ old('cargo') == "otro" ? "selected" : ""}} >Otro</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
@stop
