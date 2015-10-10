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

Route::get('/', ['middleware' => 'SessionControl', 'as' => 'home', function(){
	return View::make('home'); 
}]);

Route::get('/gestor_de_ordenes_de_servicio', ['middleware' => 'SessionControl', 'as' => 'gestor de ordenes de servicios', function(){
	return View::make('gestor_de_ordenes_de_servicio');
}]);

Route::get('/nueva_orden_de_servicio', ['middleware' => 'SessionControl', 'as' => 'nueva orden de servicio', function(){
	return View::make('nueva_orden_de_servicio');
}]);


Route::get('/reportes',['middleware' => 'SessionControl', 'as' => 'reportes', function(){
	return View::make('reportes');
}]);

Route::get('/prospectos', ['middleware' => 'SessionControl', 'as' => 'prospectos', function(){
	return View::make('prospectos');
}]);

Route::get('/empleados', ['middleware' => 'SessionControl', 'as' => 'empleados', function(){
	return View::make('empleados');
}]);

Route::get('/negocios', ['middleware' => 'SessionControl', 'as' => 'negocios', function(){
	return View::make('negocios');
}]);

Route::get('/tesoreria', ['middleware' => 'SessionControl', 'as' => 'tesoreria', function(){
	return View::make('tesoreria');
}]);

Route::get('/clientes', ['middleware' => 'SessionControl', 'as' => 'clientes', function(){
	return View::make('clientes');
}]);

Route::get('/proyeccion', ['middleware' => 'SessionControl', 'as' => 'proyeccion', function(){
	return View::make('proyeccion');
}]);

Route::get('/produccion', ['middleware' => 'SessionControl', 'as' => 'produccion', function(){
	return View::make('produccion');
}]);

Route::get('/agenda', ['middleware' => 'SessionControl', 'as' => 'agenda', function(){
	return View::make('agenda');
}]);

Route::get('/gestor_de_archivos', ['middleware' => 'SessionControl', 'as' => 'gestor de archivos', function(){
	return View::make('gestor_de_archivos');
}]);

Route::get('/configuracion', ['middleware' => 'SessionControl', 'as' => 'configuracion', function(){
	return View::make('configuracion');
}]);

Route::get('/unidades_negocio', ['middleware' => 'SessionControl', 'as' => 'unidades negocio', function(){
	return View::make('unidades_negocio');
}]);

Route::get('/programas', ['middleware' => 'SessionControl', 'as' => 'programas', function(){
	return View::make('programas');
}]);

Route::get('/productos', ['middleware' => 'SessionControl', 'as' => 'productos', function(){
	return View::make('productos');
}]);

Route::get('/blank', ['middleware' => 'SessionControl', 'as' => 'blank', function(){
	return View::make('blank');
}]);

Route::get('/usuarios', ['middleware' => 'SessionControl', 'as' => 'usuarios', function(){
	return View::make('usuarios');
}]);

Route::get('/login', ['middleware' => 'LoginControl', 'as' => 'login', function(){
	return View::make('login');
}]);

Route::controller('business_unit','businessUnitController');
Route::controller('show','showController');
Route::controller('product','productController');
Route::controller('employee','employeeController');
Route::controller('login','loginController');
//Route::controller('product','productController');
