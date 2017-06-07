@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Manual - $manual->codigosoat", "seccion" => "manual"])

@endsection

@section('administracion')

    {!! Form::model($manual) !!}
    <div class="row">
        <div class="form-group col-xs-12 col-md-4">
            {!! Form::label('tipo','Tipo de manual') !!}
            {!! Form::text('tipo',null,['class' => 'form-control','readonly' => 'readonly']) !!}
        </div>
        <div class="form-group col-xs-12 col-md-4">
            {!! Form::label('codigosoat','SOAT')   !!}
            {!! Form::text('codigosoat',null,['class' => 'form-control','readonly' => 'readonly'])!!}
        </div>
        <div class="form-group col-xs-12 col-md-4">
            {!! Form::label('estado','Estado')   !!}
            {!! Form::text('estado',null,['class' => 'form-control','readonly' => 'readonly'])   !!}
        </div>
    </div>
    {!! Form::close() !!}
    <div class="clear"></div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_manuales">
            <caption class="text-center">
                {!! Form::open(['route' => ['manuales.show',$manual->id], 'method' => 'GET', 'class' => 'text-left', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('cup',null, ['class' => 'form-control', 'placeholder' => 'Cups']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" href="/manuales/{{$manual->id}}/servicios/create"
                       class="btn btn-primary servicios">Agregar</a>
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
                <th class="text-center">Costo</th>
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
                    <td class="text-right">{{ number_format($servicio->costo,2) }}</td>
                    <td class="text-center">{{ $servicio->estado }}</td>
                    <td class="acciones">
                        <a href="/manuales/{{$manual->id}}/servicios/{{$servicio->id}}/edit" class="btn btn-success"
                           data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['manuales.servicios.destroy',$manual->id, $servicio->id], 'method' => 'delete']) !!}
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

    {!! Form::close() !!}

@stop
