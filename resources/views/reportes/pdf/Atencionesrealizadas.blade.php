@extends('reportes.pdf.layouts.plantilla')
@section("content")
     <table class="table table-striped table-bordered">
                
        <tbody>
        <tr>
            <th class="text-center">Nº de orden</th>
            <th class="text-center">Documento</th>
            <th class="text-center">Nombre</th>
           <th class="text-center">Aseguradora</th>
           <th class="text-center">Contrato</th>
            <th class="text-center">Cups</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Status</th>


        </tr>
       
              @foreach($ordenservicios as $orden)

     <tr>
            <td class="text-center">{{ $orden->id}}</td>
            <td class="text-center">{{ $orden->documento}}</td>
            <td class="text-center">{{ $orden->nombre}}</td>
            <td class="text-center">{{ $orden->aseguradora}}</td>
            <td class="text-center">{{ $orden->contrato}}</td>
            <td class="text-center">{{ $orden->cups}}</td>
            <td class="text-center">{{ $orden->descripcion}}</td>
            <td class="text-center">{{ $orden->facturado == 0 ? "Sin Facturar" : "Facturado" }}</td>
            
          
          
            </tr>
                    @endforeach  


        </tbody>
      
    </table>
@endsection
