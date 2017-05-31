@extends('layouts.layout')
@section('content')
		               

<h3 class="text-center">Editar Abono {{ $abonos->id }}</h3>
             
    <hr>
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
                           {!! Form::model($abonos, ['route' => ['abonos.update',$abonos->id], 'method' => 'put']) !!} 

                              {!! Form::hidden('id',null,['class' => 'form-control'])   !!}

                                <td class='text-center'>{!! Form::text('id_factura',null,['class' => 'form-control','readonly'])   !!}</td>                               
                                <td class='text-center'>{!! Form::text('descripcion',null,['class' => 'form-control'])   !!}</td>
                                <td class='text-center'>{!! Form::text('valor_abono',null,['class' => 'form-control','step'=>'0.01'])   !!}</td> 
                          </tr>
                  </tbody>
      </table>
      <br>
      <div class="form-group col-xs-12 col-md-12 col-lg-12">
       <button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button> 
      </div>
                         {!! Form::close() !!} 
      @endsection