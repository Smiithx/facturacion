@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Editar usuario", "seccion" => "usuario"])

@endsection

@section('administracion')
    {!! Form::model($usuarios, ['route' => ['usuarios.update',$usuarios->id], 'method' => 'put','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {!! Form::label('nombre','Nombre')   !!}
        {!! Form::text('nombre',null,['class' => 'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('documento','Documento')   !!}
        {!! Form::text('documento',null,['class' => 'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('firma','Firma')   !!}
        {!! Form::file('firma',['class' => 'form-control']) !!}
        {!! Form::hidden('file2',null,['class' => 'form-control', 'readonly'])   !!}
    </div>
    <div class="form-group">
        {!! Form::label('cargo','Cargo')   !!}
        {!! Form::select('cargo',['Medicos' => 'Medicos', 'Enfermeras' => 'Enfermeras','Otros' => 'Otros'],null,['class' => 'form-control'])   !!}
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
    {!! Form::close() !!}
@stop
