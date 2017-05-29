@extends('reportes.pdf.layouts.plantilla')
@section("content")

    <table class="table table-striped table-bordered table-hover" id="tabla_r2">
        <thead>
            <tr>
                <th class="text-center">N° de Orden</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Fecha</th>
            </tr>
        </thead>
        <tbody>
  @foreach($ordenes as $orden)
      <tr>
          <td class="text-center">{{$orden->id}}</td>
          <td>{{$orden->nombre}}</td>
          <td>{{$orden->documento}}</td>
          <td>{{$orden->aseguradora_id->nombre}}</td>
          <td>{{$orden->id_contrato->nombre}}</td>
          <td>{{$orden->created_at}}</td>
          
      </tr>
       @endforeach
        </tbody>
    </table>
@endsection
