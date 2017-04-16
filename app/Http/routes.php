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

Route::get('/', function () {
    return view('pacientes.create');
});
Route::resource('pacientes', 'PacienteController', ['only' => ['create','store','index','edit','update']]);
Route::resource('facturas', 'FacturaController', ['only' => ['create','store']]);
Route::resource('ordenservicio', 'ordenserviciocontroller', ['only' => ['create','store']]);
Route::resource('radicacion', 'RadicacionController', ['only' => ['create','store']]);
Route::resource('cartera', 'CarteraController', ['only' => ['create','store']]);
Route::resource('glosas', 'GlosasController', ['only' => ['create','store']]);
Route::resource('reportes', 'ReportesController', ['only' => ['index']]);
Route::resource('administracion', 'AdministracionController', ['only' => ['index']]);
Route::resource("test","TestController");
Route::pattern('inexistentes', '.*');
Route::any('/{inexistentes}', function()
{
    return view('errors.404');
});
