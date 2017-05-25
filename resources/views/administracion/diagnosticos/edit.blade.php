@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Editar diagnostico", "seccion" => "diagnostico"])

@endsection

@section('administracion')


    {!! Form::model($diagnosticos, ['route' => ['diagnosticos.update',$diagnosticos->id], 'method' => 'put']) !!}

    <div class="form-group">
    {!! Form::label('codigo','Código')   !!}
    {!! Form::text('codigo',null,['class' => 'form-control','required'])!!}
    </div>
    <div class="form-group">
    {!! Form::label('descripcion','Descripcion')   !!}
    {!! Form::text('descripcion',null,['class' => 'form-control','required'])!!}
    </div>

    <div class="form-group">
    {!! Form::label('estado','Estado')   !!}  
    {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control','required'])   !!}
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
    {!! Form::close() !!}

 @stop
