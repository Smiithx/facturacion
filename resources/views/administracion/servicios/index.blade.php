@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Servicios", "seccion" => "servicio"])

@endsection

@section('administracion')

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tablacitas">
        <caption class="text-center">
            {!! Form::open(['route' => 'servicios.index', 'method' => 'GET', 'class' => 'text-left', 'role' => 'search']) !!}
            <div class="input-group">
                {!! Form::text('cup',null, ['class' => 'form-control', 'placeholder' => 'Cups']) !!}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                <span class="input-group-btn">
                    <a title="Agregar" href="/servicios/create"  class="btn btn-primary servicios">Nuevo</a>
                </span>
            </div>
            {!! Form::close() !!}
            <br>
        </caption>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Cups</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $servicio)
            <tr>
                <td class="text-center">{{ $servicio->id }}</td>
                <td class="text-center">{{ $servicio->cups }}</td>
                <td>{{ $servicio->descripcion }}</td>
                <td class="text-center">{{ $servicio->estado }}</td>
                <td class="acciones">    
                    <a href="/servicios/{{$servicio->id}}/edit" class="btn btn-success" data-toggle='tooltip' title='Editar'>
                        <i class='glyphicon glyphicon-edit'></i>
                    </a>
                    {!! Form::open(['route' => ['servicios.destroy', $servicio->id], 'method' => 'delete']) !!}
                    <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'>
                        <i class='glyphicon glyphicon-remove'></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container-fluid text-center">
        {!! $servicios->render() !!}
    </div>
</div> 
@endsection