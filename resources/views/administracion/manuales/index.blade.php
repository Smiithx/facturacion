@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Manuales", "seccion" => "manual"])

@endsection

@section('administracion')

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_manuales">
            <caption class="text-center">
                {!! Form::open(['route' => 'manuales.index', 'method' => 'GET', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('soat',$soat, ['class' => 'form-control', 'placeholder' => 'Codigo soat']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" href="/manuales/create" class="btn btn-primary servicios">Nuevo</a>
                </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">SOAT</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($manuales as $manual)
                <tr>
                    <td class="text-center"><a href="/manuales/{{ $manual->id }}">{{ $manual->id }}</a></td>
                    <td>{{ $manual->tipo }}</td>
                    <td>{{ $manual->codigosoat }}</td>
                    <td class="text-center">{{ $manual->estado }}</td>
                    <td class="acciones">
                        <a href="/manuales/{{$manual->id}}/edit" class="btn btn-success" data-toggle='tooltip'
                           title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['manuales.destroy', $manual->id], 'method' => 'delete']) !!}
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
            {!! $manuales->render() !!}
        </div>
    </div>
@stop