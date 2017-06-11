@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Contratos", "seccion" => "contrato"])

@endsection

@section('administracion')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <caption class="text-center">
                {!! Form::open(['route' => 'contratos.index', 'method' => 'GET', 'class' => 'text-left', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('nombre',$nombre, ['class' => 'form-control', 'placeholder' => 'Nombre del contrato']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" href="/contratos/create" class="btn btn-primary">Nuevo</a>
                </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">NIT</th>
                <th class="text-center">Días V.</th>
                <th class="text-center">Manual</th>
                <th class="text-center">Porcentaje</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td class="text-center">{{ $contrato->id }}</td>
                    <td>{{ $contrato->nombre }}</td>
                    <td>{{ $contrato->nit}}</td>
                    <td class="text-center">{{ $contrato->diasvencimiento }}</td>
                    <td>{{ $contrato->id_manual->nombre }}</td>
                    <td class="text-center">{{ $contrato->porcentaje }}%</td>
                    <td class="text-center">{{ $contrato->estado }}</td>
                    <td class="acciones">
                        <a href="/contratos/{{$contrato->id}}/edit" class="btn btn-success"
                           data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['contratos.destroy', $contrato->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'
                                target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container-fluid text-center">
            {!! $contratos->render() !!}
        </div>
    </div>
@stop