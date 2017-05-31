@extends('layouts.layout')
@section('content')
		               

<h3 class="text-center">Crear Abono a Factura {{ $facturas->id }}</h3>
             
    <hr>
    <form method="POST" action="/abonos">

			 <table class="table table-striped table-bordered table-hover table-responsive " style="align: center; width: 98%; margin: 1%; background: #3DA40A;" id="tbl_abono">
                 <thead style="color: #fff;">
	                        <tr> 
	                        <th class="text-center"># Factura</th>           
	                        <th class="text-center">Descripcion</th>
	                        <th class="text-center">Monto Abonar</th>

	
	                        </tr>
                      	</thead>

                      	<tbody id="abono_tbody">
                      	<tr>
                      	  <input class="form-control" value="{{ $facturas->id }}"  readonly  id="abono_factura" type="hidden" name="id_factura"/>

                            <td class='text-center'><a href='/facturas/{{$facturas->id}}' target='_blank'>{{$facturas->id}}</a></td> 
                               <td><input id='descripcion_abonar'  required type='text' name='descripcion'    class='form-control'></td>  
                           <td><input id='monto_abonar' step='0.01'  required type='number' name='valor_abono'    class='form-control'></td>
                                             

                            </td>
                            </tr>

                      	</tbody>
                    </table>
                    <br>
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    	<input class="btn btn-primary pull-right" type="submit" id="abono"  name="glosar" value="Guardar">
                    </div>
                   {{csrf_field()}}
    </form>
             
	
@endsection