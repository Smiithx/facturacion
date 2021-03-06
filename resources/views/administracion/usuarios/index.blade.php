@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Usuarios", "seccion" => "usuario"])

@endsection

@section('administracion')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_usuarios">
            <caption class="text-center">
                {!! Form::open(['route' => 'usuarios.index', 'method' => 'GET', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('name',$name, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" href="/usuarios/create" class="btn btn-primary">Nuevo</a>
                </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th class="text-center">Firma</th>
                <th>Cargo</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td class="text-center">{{ $usuario->id }}
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->documento }}</td>
                    <td class="text-center">
                        <img class="img-responsive firma" src="/imagenes/{{ $usuario->firma }}"
                             alt="imagenes/{{$usuario->firma}}">
                    </td>
                    <td>{{ $usuario->cargo }}</td>
                    <td class="acciones">
                        <a href="/usuarios/{{$usuario->id}}/edit" class="btn btn-success"
                           data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['usuarios.destroy', $usuario->id], 'method' => 'delete','class' => 'form_eliminar_usuario']) !!}
                        <button type="submit" data-id="{{$usuario->id}}" class="btn btn-danger btn_eliminar_usuario" data-toggle='tooltip' title='Eliminar'>
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'password.email', 'method' => 'post']) !!}
                        <input type="hidden" class="form-control" name="email" value="{{$usuario->email }}">
                        <button type="submit" class="btn btn-info" data-toggle='tooltip' title='Restablecer contraseña'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container-fluid text-center">
            {!! $usuarios->render() !!}
        </div>
    </div>
    <script src="{{asset('assets/js/usuario.js')}}"></script>

@stop