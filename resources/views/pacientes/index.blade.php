@extends('layouts.layout')
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <caption class="text-center">
                <h2>Pacientes</h2>
                <div class="row">
                    {!! Form::open(['route' => 'pacientes.index', 'method' => 'GET', 'class' => 'container-fluid text-left', 'role' => 'search']) !!}
                    <div class="input-group">
                        {!! Form::text('name',null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </caption>
            <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Aseguradora</th>
                <th>Contrato</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->documento }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->edad." ".$paciente->tipo_edad }}</td>
                    <td>{{ $paciente->sexo }}</td>
                    <td>{{ $paciente->aseguradora->nombre }}</td>
                    <td>{{ $paciente->contrato }}</td>
                    <td class="acciones">
                        <a href="/pacientes/{{$paciente->id}}/edit" class="btn btn-success" data-toggle='tooltip'
                           title='Editar' target="_blank">
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['pacientes.destroy', $paciente->id], 'method' => 'delete','id' => 'form-eliminar-paciente']) !!}
                        {{ csrf_field() }}
                        <button type="submit" data-id="{{$paciente->id}}" class="btn btn-danger btn-eliminar-paciente"
                                data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7" class="text-center">{!! $pacientes->render() !!}</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <script src="{{asset('assets/js/pacientes.js')}}"></script>
@endsection