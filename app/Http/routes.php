<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//----- Inicio ----- //
Route::get('/','PacienteController@index');

//----- Pacientes ----- //
Route::resource('pacientes', 'PacienteController');
Route::get('pacientes/documento/{documento}', 'PacienteController@documento');

//----- Facturas ----- //
Route::resource('facturas', 'FacturaController', ['only' => ['index','create','store','show']]);
Route::get('facturas/buscar/{aseguradora}/{contrato}/{desde}/{hasta}', 'FacturaController@buscar');
Route::get('facturas/radicar/{contrato}/{desde}/{hasta}', 'FacturaController@radicar');
Route::get('facturas/reporte/factura', 'FacturaController@reporteFactura');
Route::get('facturas/reporte/factura/{factura}', 'FacturaController@reporteFacturaShow');

//----- Orden de servicios ----- //
Route::resource('ordenservicio', 'ordenserviciocontroller', ['only' => ['create','store','show']]);
Route::get('ordenservicio/buscar/{contrato}/{desde}/{hasta}', 'ordenserviciocontroller@buscar');

//----- Radicacion ----- // 
Route::resource('radicacion', 'RadicacionController', ['only' => ['create','store']]);
Route::get('radicacion/contrato/create', 'RadicacionController@radicarContrato');
Route::post('radicacion/contrato', 'RadicacionController@storeContrato');
Route::get('radicacion/buscar/{desde}/{hasta}', 'RadicacionController@buscar');

//----- Cartera ----- //
Route::resource('cartera', 'CarteraController', ['only' => ['create','store']]);

//----- Glosas ----- //
Route::resource('glosas', 'GlosasController', ['only' => ['create','store']]);

//----- Reportes ----- //
Route::resource('reportes', 'ReportesController', ['only' => ['index']]);
Route::get('reportes/totalfacturado', 'ReportesController@reportefacturacion');
Route::get('reportes/totalfacturado/pdf', 'ReportesController@reportefacturacionpdf');
Route::get('reportes/Ordenesporfacturar', 'ReportesController@Ordenesporfacturar');
Route::get('reportes/Ordenesporfacturar/pdf', 'ReportesController@Ordenesporfacturarpdf');
Route::get('reportes/Atencionesrealizadas', 'ReportesController@Atencionesrealizadas');
Route::get('reportes/Atencionesrealizadas/pdf', 'ReportesController@Atencionesrealizadaspdf');
Route::get('reportes/Imprimirfactura', 'ReportesController@Imprimirfactura');
Route::get('reportes/Imprimirfactura/pdf', 'ReportesController@Imprimirfacturapdf');
Route::get('reportes/Cuentadecobro', 'ReportesController@Cuentadecobro');
Route::get('reportes/Cuentadecobro/pdf', 'ReportesController@Cuentadecobropdf');
Route::get('reportes/radicacion', 'ReportesController@radicacion');
Route::get('reportes/radicacion/pdf', 'ReportesController@radicacionpdf');

//----- Administracion ----- //
Route::resource('administracion', 'AdministracionController', ['only' => ['index']]);
Route::get('administracion/usuarios', 'AdministracionController@usuarios');
Route::get('administracion/usuarios/create', 'AdministracionController@createusuario');
Route::get('administracion/usuarios/{id}/edit', 'AdministracionController@editusuarios');
Route::get('administracion/servicios', 'AdministracionController@servicios');
Route::get('administracion/servicios/create', 'AdministracionController@createservicio');
Route::get('administracion/servicios/{id}/edit', 'AdministracionController@editservicio');
Route::get('administracion/aseguradoras', 'AdministracionController@aseguradoras');
Route::get('administracion/aseguradoras/{id}/edit', 'AdministracionController@editaseguradora');
Route::get('administracion/contratos', 'AdministracionController@contratos');
Route::get('administracion/contratos/{id}/edit', 'AdministracionController@editcontratos');
Route::get('administracion/contratos/create', 'AdministracionController@createcontratos');
Route::get('administracion/diagnosticos', 'AdministracionController@diagnosticos');
Route::get('administracion/diagnosticos/{id}/edit', 'AdministracionController@editdiagnosticos');
Route::get('administracion/diagnosticos/create', 'AdministracionController@creatediagnosticos');
Route::get('administracion/manuales', 'AdministracionController@manuales');
Route::get('administracion/manuales/{id}/edit', 'AdministracionController@editmanuales');
Route::get('administracion/manuales/create', 'AdministracionController@createmanuales');

//----- Contratos ----- //
Route::resource('Contratos', 'ContratosController', ['only' => ['create','store','destroy','update']]);

//----- Manuales ----- //
Route::resource('Manuales', 'ManualesController', ['only' => ['create','store','destroy','update']]);

//----- Empresa ----- //
Route::resource('Empresa', 'EmpresaController', ['only' => ['create','store','destroy','update']]);

//----- Aseguradora ----- //
Route::resource('Aseguradora', 'AseguradoraController');

//----- Diagnosticos ----- //
Route::resource('Diagnosticos', 'DiagnosticosController', ['only' => ['create','store','destroy','update']]);

//----- Usuarios ----- //
Route::resource('Usuarios', 'UsuariosController', ['only' => ['create','store','destroy','update']]);

//----- Servicios ----- //
Route::resource('Servicios', 'ServiciosController', ['only' => ['create','store','destroy','update']]);
Route::get('servicios/cups/{cups}','ServiciosController@cups');

//----- Test ----- //
Route::resource("test","TestController");


//----- Error 404 ----- //
Route::pattern('inexistentes', '.*');
Route::any('/{inexistentes}', function()
{
    return view('errors.404');
});
