@extends('layouts.layout')
@section('content')

<div class="" >
		    <div class="container-fluid">
		    <div  class="col-sm-12">
		        <h3 class="text-center">Ajustes</h3>
		        
		        <div class="col-xs-3">
		            <!-- required for floating -->
		            <!-- Nav tabs -->
		            <ul class="nav nav-tabs tabs-left">
		                <li class="active link"><a href="#datose" data-toggle="tab">Datos de la empresa</a></li>
		                <li class="link"><a href="#usuarios" data-toggle="tab">Usuarios</a></li>
		                <li class="link"><a href="#tipocita" data-toggle="tab">Tipos de Servicios</a></li>
		                <li class="link"><a href="#aseguradoras" data-toggle="tab">Aseguradoras y contratos</a></li>
		                <li class="link"><a href="#manuales" data-toggle="tab">Manuales</a></li>
		                
		            </ul>
		        </div>
		        <div class="col-xs-9">
		            <!-- Tab panes -->
		            <div class="tab-content">
		                
 @yield('administracion')		               
  </div>
		            </div>
		        </div>
		        <div class="clearfix"></div>
		    </div>
    		</div>
		


@endsection