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

Route::get('/', function()
{
	return View::make('home'); 
});

Route::get('/comercializacion', function()
{
	return View::make('comercializacion');
});

Route::get('/reportes', function()
{
	return View::make('reportes');
});

Route::get('/prospectos', function()
{
	return View::make('prospectos');
});

Route::get('/empleados', function()
{
	return View::make('empleados');
});

Route::get('/negocios', function()
{
	return View::make('negocios');
});

Route::get('/pagos', function()
{
	return View::make('pagos');
});

Route::get('/clientes', function()
{
	return View::make('clientes');
});

Route::get('/proyeccion', function()
{
	return View::make('proyeccion');
});

Route::get('/blank', function()
{
	return View::make('blank');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::get('/usuarios', function()
{
	return View::make('usuarios');
});

Route::controller('employee','employeeController');
Route::controller('customer','customerController');
Route::controller('user','userController');
Route::controller('serviceOrder','serviceOrderController');
