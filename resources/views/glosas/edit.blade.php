@extends('layouts.layout')
@section('content')
<h3 class="text-center">Editar Glosa # </h3>
    <hr>
    <form method="post" action="/glosas/update">
		

			
		         <table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_glosas">
                 <thead style="color: #fff;">
	                        <tr> 
	                        <th class="text-center">Factura</th>
                           <th class="text-center">Valor Factura</th>
	                          <th class="text-center">Valor Glosa</th>
	                          <th class="text-center">Valor Aceptado</th>
                            </tr>
                  </thead>

                      	<tbody id="glosas_tbody">
                          @foreach($glosas as $glosa)                
                            <tr>
                            <td class='text-center'>
                            <a href='/facturas/{{ $glosa->id_factura }} ' target='_blank'>{{ $glosa->id_factura }} </a>
                            </td> <input type="hidden" name="id"  value="{{ $glosa->id }}">
                            <td>{{ number_format($glosa->factura_total,2) }}</td>
                            <td><input style='width: 100%;' type='number' step="0.00" name='valor_glosa' value="{{ $glosa->valor_glosa }}" required></td>
                            <td><input style='width: 100%;' type='text'  value="{{ $glosa->valor_aceptado }}" name='valor_aceptado' required></td>
                            </tr>
                            @endforeach
                      	</tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    	<input class="btn btn-primary pull-right" type="submit" id="glosas"  name="glosar" value="Guardar">
                    </div>
                   {{csrf_field()}}
    </form>
             
	
@endsection