@extends('layouts.layout')
@section('content')
<h3 class="text-center">Editar Cartera # </h3>
    <hr>
    <form method="post" action="/cartera/update">
		

			
		         <table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_cartera">
                 <thead style="color: #fff;">
	                        <tr> 
	                        <th class="text-center">Factura</th>
                           <th class="text-center">Valor Abono</th>
	                          <th class="text-center">Valor Retencion</th>
                            </tr>
                  </thead>

                      	<tbody id="cartera_tbody">
                          @foreach($carteras as $cartera)                
                            <tr>
                            <td class='text-center'>
                            <a href='/facturas/{{ $cartera->id_factura }} ' target='_blank'>{{ $cartera->id_factura }} </a>
                            </td> <input type="hidden" name="id"  value="{{ $cartera->id }}">
                            <td><input style='width: 100%;' type='number' step="0.00" name='valor_abono' value="{{ $cartera->valor_abono }}" required></td>
                            <td><input style='width: 100%;' type='text'  value="{{ $cartera->valor_retencion }}" name='valor_retencion' required></td>
                            </tr>
                            @endforeach
                      	</tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    	<input class="btn btn-primary pull-right" type="submit" id="cartera"  name="cartera" value="Guardar">
                    </div>
                   {{csrf_field()}}
    </form>
             
	
@endsection