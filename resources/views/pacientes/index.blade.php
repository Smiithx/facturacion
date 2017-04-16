@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="container-fluid table-responsive" style="background-color: #f9f9f9;">
        <table class="table table-striped table-hover table-bordered">
            <caption class="text-center"><h2>Pacientes</h2></caption>
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
                    <td>{{ $paciente->edad }}</td>
                    <td>{{ $paciente->sexo }}</td>
                    <td>{{ $paciente->aseguradora }}</td>
                    <td>{{ $paciente->contrato }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection