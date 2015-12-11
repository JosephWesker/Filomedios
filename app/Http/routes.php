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

Route::get('/login', ['middleware' => 'LoginControl', 'as' => 'login', function(){
	return View::make('login');
}]);

Route::controller('logincont','loginController');

Route::get('/', ['middleware' => 'SessionControl', 'as' => 'home', function(){
	return View::make('home'); 
}]);

Route::get('/gestor_de_ordenes_de_servicio', ['middleware' => 'SessionControl', 'as' => 'gestor de ordenes de servicios', function(){
	if (Session::get('type') == 'vendedor') {
		return View::make('gestor_de_ordenes_de_servicio_vendedor');
	} else {
		return View::make('gestor_de_ordenes_de_servicio');
	}	
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

Route::get('/facturas', ['middleware' => 'SessionControl', 'as' => 'facturas', function(){
	return View::make('facturas');
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
	return View::make('programas', array('title' => 'Programas', 'readAll' => action('showController@postReadAll'), 'delete' => action('showController@postDelete')));
}]);

Route::get('/programas/eliminados', ['middleware' => 'SessionControl', 'as' => 'programas eliminados', function(){
	return View::make('programas', array('title' => 'Programas Eliminados', 'readAll' => action('showController@postReadAllDelete'), 'delete' => action('showController@postActivate')));
}]);

Route::get('/productos', ['middleware' => 'SessionControl', 'as' => 'productos', function(){
	return View::make('productos');
}]);

Route::get('/paquetes', ['middleware' => 'SessionControl', 'as' => 'paquetes', function(){
	return View::make('paquetes');
}]);

Route::get('/blank', ['middleware' => 'SessionControl', 'as' => 'blank', function(){
	return View::make('blank');
}]);

Route::get('/usuarios', ['middleware' => 'SessionControl', 'as' => 'usuarios', function(){
	return View::make('usuarios');
}]);

Route::get('/perfil', ['middleware' => 'SessionControl', 'as' => 'perfil', function(){
	return View::make('profile');
}]);

Route::get('/paquetes/{id}', ['uses' => 'packageController@showDetail','middleware' => 'SessionControl']);

Route::get('/gestor_de_ordenes_de_servicio/{id}', ['uses' => 'serviceOrderController@showServiceOrder','middleware' => 'SessionControl']);

Route::get('/gestor_de_ordenes_de_servicio/download/{folder}/{serviceOrder}/{file}', ['uses' => 'serviceOrderController@downloadFile','middleware' => 'SessionControl']);

Route::get('/tesoreria/{id}', ['uses' => 'treasuryController@readPayments','middleware' => 'SessionControl']);

Route::get('/tesoreria/pago/{id}', ['uses' => 'treasuryController@detailPayment','middleware' => 'SessionControl']);

Route::get('/unidades_negocio/{id}/empleados', ['uses' => 'employeeController@loadEmployeesByBusinessUnit','middleware' => 'SessionControl']);

Route::controller('business_unit','businessUnitController');
Route::controller('show','showController');
Route::controller('product','productController');
Route::controller('employee','employeeController');
Route::controller('package','packageController');
Route::controller('customer','customerController');
Route::controller('serviceOrder','serviceOrderController');
Route::controller('treasury','treasuryController');
Route::controller('production','productionController');
//Route::controller('product','productController');
