@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Editar aseguradora - $aseguradora->nombre", "seccion" => "aseguradora"])

@endsection

@section('administracion')

    {!! Form::model($aseguradora, ['route' => ['aseguradoras.update',$aseguradora->id], 'method' => 'put']) !!}

    <div class="form-group">
        {!! Form::label('nombre','Nombre:')   !!}
        {!! Form::text('nombre',null,['class' => 'form-control','required' => 'required'])   !!}
    </div>
    <div class="form-group">
        {!! Form::label('nit','NIT:')   !!}
        {!! Form::text('nit',null,['class' => 'form-control','required' => 'required'])   !!}
    </div>
    <div class="form-group">
        {!! Form::label('estado','Estado:')   !!}
        {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control','required' => 'required'])   !!}
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>

    {!! Form::close() !!}

@stop
