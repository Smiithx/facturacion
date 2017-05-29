@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Diagnosticos", "seccion" => "diagnostico"])

@endsection

@section('administracion')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_diagnosticos">
            <caption class="text-center">
                {!! Form::open(['route' => 'diagnosticos.index', 'method' => 'GET', 'class' => 'text-left', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('codigo',$codigo, ['class' => 'form-control', 'placeholder' => 'Código del diagnostico']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" href="/diagnosticos/create" class="btn btn-primary">Nuevo</a>
                </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Código</th>
                <th>Descripción</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($diagnosticos as $diagnostico)
                <tr>
                    <td class="text-center">{{ $diagnostico->id }}</td>
                    <td>{{ $diagnostico->codigo }}</td>
                    <td>{{ $diagnostico->descripcion }}</td>
                    <td class="text-center">{{ $diagnostico->estado }}</td>
                    <td class="acciones">
                        <a href="/diagnosticos/{{$diagnostico->id}}/edit" class="btn btn-success"
                           data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['diagnosticos.destroy', $diagnostico->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'
                                target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container-fluid text-center">
            {!! $diagnosticos->render()!!}
        </div>
    </div>
@stop