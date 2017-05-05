@extends('reportes.pdf.layouts.plantilla')
@section('plantilla') 
  <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r1">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
             
                <th class="text-center">#</th>
                <th class="text-center">Fecha expedición</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Valor unitario</th>
                <th class="text-center">Valor total</th>
             
            </tr>
           </thead>
        <tbody>
      
 <tr>
            <td class="no">{{ $data['quantity'] }}</td>
            <td class="desc">{{ $data['description'] }}</td>
            <td class="unit">{{ $data['price'] }}</td>
            <td class="total">{{ $data['total'] }} </td>
          </tr>
 
 
        </tbody>
    </table> 
@endsection