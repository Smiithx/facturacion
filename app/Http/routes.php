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

//----- Aseguradora ----- //
Route::resource('Aseguradora', 'AseguradoraController');

//---Abonos--//
Route::resource('abonos', 'AbonosController');
Route::get('abonos/create/{id}','AbonosController@create');

//----- Servicios ----- //
Route::resource('servicios', 'ServiciosController');
Route::get('servicios/cups/{cups}/{contrato}','ServiciosController@cups');
Route::post('Servicios/buscar','ServiciosController@buscar');

//----- Contratos ----- //
Route::resource('contratos', 'ContratosController');
Route::post('Contratos/buscar','ContratosController@buscar');

//----- Manuales ----- //
Route::resource('manuales', 'ManualesController');
Route::post('Manuales/buscar','ManualesController@buscar');
Route::get('manuales/{cups}/{contrato}','ManualesController@cups');

//----- Manuales servicios ----- //
Route::resource('manuales.servicios', 'ManualServiciosController');

//----- Pacientes ----- //
Route::resource('pacientes', 'PacienteController');
Route::get('pacientes/documento/{documento}', 'PacienteController@documento');

//----- Orden de servicios ----- //
Route::resource('ordenservicio', 'ordenserviciocontroller', ['only' => ['create','store','edit','show','index']]);
Route::get('ordenservicio/buscar/{contrato}/{desde}/{hasta}', 'ordenserviciocontroller@buscar');
Route::get('ordenservicio/ordenes_facturar/{desde}/{hasta}', 'ordenserviciocontroller@ordenes_facturar');
Route::get('ordenservicio/factura/{factura}', 'ordenserviciocontroller@factura');
Route::get('ordenservicio/documento/{documento}', 'ordenserviciocontroller@documento');

//----- Facturas ----- //
Route::resource('facturas', 'FacturaController', ['only' => ['index','create','store','show']]);
Route::get('facturas/buscar/{aseguradora}/{contrato}/{desde}/{hasta}', 'FacturaController@buscar');
Route::get('facturas/radicar/{contrato}/{desde}/{hasta}', 'FacturaController@radicar');
Route::get('facturas/cuentacobro/buscar/{factura}', 'FacturaController@cxcbuscar');
Route::get('facturas/reporte/factura', 'FacturaController@reporteFactura');
Route::get('facturas/reporte/factura/{factura}', 'FacturaController@reporteFacturaShow');
Route::get('facturas/reporte/contrato', 'FacturaController@reporteContrato');
Route::get('facturas/reporte/contrato/{contrato}/{desde}/{hasta}', 'FacturaController@reporteContratoShow');

//----- Radicacion ----- // 
Route::resource('radicacion', 'RadicacionController', ['only' => ['create','store']]);
Route::get('radicacion/contrato/create', 'RadicacionController@radicarContrato');
Route::post('radicacion/contrato', 'RadicacionController@storeContrato');
Route::get('radicacion/buscar/{desde}/{hasta}', 'RadicacionController@buscar');

//----- Cartera ----- //
Route::resource('cartera', 'CarteraController', ['only' => ['create','edit','store']]);
Route::get('cartera/buscar/{factura}/{contrato}', 'CarteraController@buscar');
Route::get('cartera/create/contrato', 'CarteraController@createcontrato');
Route::get('cartera/reporte/{factura}', 'CarteraController@reportefactura');
Route::get('cartera/buscar/{factura}', 'CarteraController@reportebuscar');
Route::post('cartera/update', 'CarteraController@update');
Route::get('cartera/editar', 'CarteraController@editar');


//----- Glosas ----- //
Route::resource('glosas', 'GlosasController', ['only' => ['create','store','edit','destroy','update']]);
Route::get('glosas/editar', 'GlosasController@editar');
Route::get('glosas/buscar/{factura}/{contrato}', 'GlosasController@buscar');
Route::post('glosas/update', 'GlosasController@update');
Route::get('glosas/buscar/{factura}', 'GlosasController@reportebuscar');
Route::get('glosas/create/contrato', 'GlosasController@createcontrato');

//----- Reportes ----- //
Route::resource('reportes', 'ReportesController', ['only' => ['index']]);
Route::get('reportes/glosas','ReportesController@reporteglosas');
Route::get('reportes/carteras','ReportesController@reportecarteras');

Route::get('reportes/totalfacturado', 'ReportesController@reportefacturacion');
Route::get('reportes/totalfacturado/pdf', 'ReportesController@reportefacturacionpdf');

Route::get('reportes/Ordenesporfacturar', 'ReportesController@Ordenesporfacturar');
Route::get('reportes/Ordenesporfacturar/pdf/{id}', 'ReportesController@Ordenesporfacturarpdf');

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
Route::get('administracion/aseguradoras', 'AdministracionController@aseguradoras');
Route::get('administracion/aseguradoras/{id}/edit', 'AdministracionController@editaseguradora');

Route::get('administracion/diagnosticos', 'AdministracionController@diagnosticos');
Route::get('administracion/diagnosticos/{id}/edit', 'AdministracionController@editdiagnosticos');
Route::get('administracion/diagnosticos/create', 'AdministracionController@creatediagnosticos');

//----- Empresa ----- //
Route::resource('empresa', 'EmpresaController');

//----- Diagnosticos ----- //
Route::resource('Diagnosticos', 'DiagnosticosController', ['only' => ['create','store','destroy','update']]);

//----- Usuarios ----- //
Route::resource('Usuarios', 'UsuariosController', ['only' => ['create','store','destroy','update']]);
Route::post('Usuarios/buscar','UsuariosController@buscar');

//----- Test ----- //
Route::resource("test","TestController");

//----- Error 404 ----- //
Route::pattern('inexistentes', '.*');
Route::any('/{inexistentes}', function()
{
    return view('errors.404');
});
