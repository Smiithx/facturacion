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

Route::get('/','PacienteController@index');
Route::resource('pacientes', 'PacienteController');
Route::get('pacientes/documento/{documento}', 'PacienteController@documento');

Route::resource('facturas', 'FacturaController', ['only' => ['index','create','store']]);

Route::resource('ordenservicio', 'ordenserviciocontroller', ['only' => ['create','store']]);

Route::resource('radicacion', 'RadicacionController', ['only' => ['create','store']]);

Route::resource('cartera', 'CarteraController', ['only' => ['create','store']]);

Route::resource('glosas', 'GlosasController', ['only' => ['create','store']]);

Route::resource('reportes', 'ReportesController', ['only' => ['index']]);

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






Route::resource('Manuales', 'ManualesController', ['only' => ['create','store','destroy','update']]);
Route::resource('Empresa', 'EmpresaController', ['only' => ['create','store','destroy','update']]);
Route::resource('Aseguradora', 'AseguradoraController');
Route::resource('Diagnosticos', 'DiagnosticosController', ['only' => ['create','store','destroy','update']]);
Route::resource('Usuarios', 'UsuariosController', ['only' => ['create','store','destroy','update']]);
Route::resource('Servicios', 'ServiciosController', ['only' => ['create','store','destroy','update']]);


Route::resource("test","TestController");

Route::pattern('inexistentes', '.*');
Route::any('/{inexistentes}', function()
{
    return view('errors.404');
});
