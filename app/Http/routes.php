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

Route::resource('facturas', 'FacturaController', ['only' => ['create','store']]);

Route::resource('ordenservicio', 'ordenserviciocontroller', ['only' => ['create','store']]);

Route::resource('radicacion', 'RadicacionController', ['only' => ['create','store']]);

Route::resource('cartera', 'CarteraController', ['only' => ['create','store']]);

Route::resource('glosas', 'GlosasController', ['only' => ['create','store']]);

Route::resource('reportes', 'ReportesController', ['only' => ['index']]);

Route::resource('administracion', 'AdministracionController', ['only' => ['index']]);
Route::get('administracion/usuarios', 'AdministracionController@usuarios');
Route::get('administracion/manuales', 'AdministracionController@manuales');
Route::get('administracion/procedimientos', 'AdministracionController@procedimientos');
Route::get('administracion/servicios', 'AdministracionController@servicios');
Route::get('administracion/diagnosticos', 'AdministracionController@diagnosticos');
Route::get('administracion/medicamentos', 'AdministracionController@medicamentos');
Route::get('administracion/plantillas', 'AdministracionController@plantillas');






Route::get('administracion/aseguradoras', 'AdministracionController@aseguradoras');
Route::resource('Aseguradora', 'AseguradoraController', ['only' => ['create','store','destroy','update']]);
Route::get('administracion/aseguradoras/edit/{id}', 'AdministracionController@editaseguradora');


Route::resource("test","TestController");

Route::pattern('inexistentes', '.*');
Route::any('/{inexistentes}', function()
{
    return view('errors.404');
});
