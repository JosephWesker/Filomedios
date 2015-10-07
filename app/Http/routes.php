<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return View::make('home'); 
});

Route::get('/gestor_de_ordenes_de_servicio', function(){
	return View::make('gestor_de_ordenes_de_servicio');
});

Route::get('/nueva_orden_de_servicio', function(){
	return View::make('nueva_orden_de_servicio');
});


Route::get('/reportes', function(){
	return View::make('reportes');
});

Route::get('/prospectos', function(){
	return View::make('prospectos');
});

Route::get('/empleados', function(){
	return View::make('empleados');
});

Route::get('/negocios', function(){
	return View::make('negocios');
});

Route::get('/tesoreria', function(){
	return View::make('tesoreria');
});

Route::get('/clientes', function(){
	return View::make('clientes');
});

Route::get('/proyeccion', function(){
	return View::make('proyeccion');
});

Route::get('/produccion', function(){
	return View::make('produccion');
});

Route::get('/agenda', function(){
	return View::make('agenda');
});

Route::get('/gestor_de_archivos', function(){
	return View::make('gestor_de_archivos');
});

Route::get('/configuracion', function(){
	return View::make('configuracion');
});

Route::get('/unidades_negocio', function(){
	return View::make('unidades_negocio');
});

Route::get('/programas', function(){
	return View::make('programas');
});

Route::get('/productos', function()
{
	return View::make('productos');
});

Route::get('/blank', function(){
	return View::make('blank');
});

Route::get('/login', function(){
	return View::make('login');
});

Route::get('/usuarios', function(){
	return View::make('usuarios');
});

Route::controller('business_unit','businessUnitController');
Route::controller('show','showController');
Route::controller('product','productController');
Route::controller('employee','employeeController');
//Route::controller('product','productController');
