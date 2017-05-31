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

//----- Login ----- //

// Authentication routes...
Route::get('/login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'login'
]);
Route::post('/login', [
    'uses' => 'Auth\AuthController@postLogin',
    "as" => "login"
]);
Route::get('/logout', [
    "uses" => 'Auth\AuthController@getLogout',
    "as" => "logout"
]);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//----- Inicio ----- //
Route::get('/',[
    "uses" => 'PacienteController@index',
    "as" => "home"
]);

//----- Aseguradora ----- //
Route::resource('aseguradoras', 'AseguradoraController');

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
Route::get('ordenservicio/{id}/anular', 'ordenserviciocontroller@anular');
Route::get('ordenservicio/atenciones/{desde}/{hasta}', 'ordenserviciocontroller@atenciones');


//----- Facturas ----- //
Route::resource('facturas', 'FacturaController', ['only' => ['index','create','store','show']]);
Route::get('facturas/buscar/{aseguradora}/{contrato}/{desde}/{hasta}', 'FacturaController@buscar');
Route::get('facturas/radicar/{contrato}/{desde}/{hasta}', 'FacturaController@radicar');
Route::get('facturas/cuentacobro/buscar/{factura}', 'FacturaController@cxcbuscar');
Route::get('facturas/reporte/factura', 'FacturaController@reporteFactura');
Route::get('facturas/reporte/factura/{factura}', 'FacturaController@reporteFacturaShow');
Route::get('facturas/reporte/contrato', 'FacturaController@reporteContrato');
Route::get('facturas/reporte/contrato/{contrato}/{desde}/{hasta}', 'FacturaController@reporteContratoShow');
Route::get('facturas/imprimir/{anulado}/{desde}/{hasta}', 'FacturaController@imprimir');
Route::get('facturas/{id}/anular', 'FacturaController@anular');


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
Route::get('reportes/totalfacturado/pdf/{aseguradora}/{contrato}/{desde}/{hasta}', 'ReportesController@reportefacturacionpdf');

Route::get('reportes/Ordenesporfacturar', 'ReportesController@Ordenesporfacturar');
Route::get('reportes/Ordenesporfacturar/pdf/{inicio}/{fin}', 'ReportesController@Ordenesporfacturarpdf');

Route::get('reportes/Atencionesrealizadas', 'ReportesController@Atencionesrealizadas');
Route::get('reportes/atencionesrealizadas/pdf/{desde}/{hasta}', 'ReportesController@Atencionesrealizadaspdf');
Route::get('reportes/Imprimirfactura', 'ReportesController@Imprimirfactura');
Route::get('reportes/imprimirfacturas/pdf/{id}', 'ReportesController@Imprimirfacturapdf');
Route::get('reportes/Cuentadecobro', 'ReportesController@Cuentadecobro');
Route::get('reportes/Cuentadecobro/pdf/{id}', 'ReportesController@Cuentadecobropdf');
Route::get('reportes/radicacion', 'ReportesController@radicacion');
Route::get('reportes/radicacion/pdf/{desde}/{hasta}', 'ReportesController@radicacionpdf');

//----- Administracion ----- //
Route::resource('administracion', 'AdministracionController', ['only' => ['index']]);

//----- Empresa ----- //
Route::resource('empresa', 'EmpresaController');

//----- Diagnosticos ----- //
Route::resource('diagnosticos', 'DiagnosticosController');

//----- Usuarios ----- //
Route::resource('usuarios', 'UsuariosController');

//----- Test ----- //
Route::resource("test","TestController");

//----- Error 404 ----- //
Route::pattern('inexistentes', '.*');
Route::any('/{inexistentes}', function()
{
    return view('errors.404');
});
