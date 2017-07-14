<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/admin/{admin}/enable', 'AdminController@enable');
Route::post('/admin/{admin}/disable', 'AdminController@disable');
Route::resource('admin', 'AdminController');

Route::post('/empleado/{empleado}/enable', 'EmpleadoController@enable');
Route::post('/empleado/{empleado}/disable', 'EmpleadoController@disable');
Route::get('/empleado/{empleado}/jornada', 'EmpleadoController@jornada');
Route::get('/empleado/{empleado}/extras', 'EmpleadoController@extras');
Route::get('/empleado/{empleado}/descanso', 'EmpleadoController@descanso');
Route::get('/empleado/{empleado}/historial', 'EmpleadoController@historial');
Route::post('/empleado/{empleado}/iniciar', 'EmpleadoController@iniciar');
Route::post('/empleado/{empleado}/finalizar', 'EmpleadoController@finalizar');
Route::resource('empleado', 'EmpleadoController');

Route::post('/jornada/{jornada}/enable', 'JornadaController@enable');
Route::post('/jornada/{jornada}/disable', 'JornadaController@disable');
Route::get('/jornada/{jornada}/empleados', 'JornadaController@empleados');
Route::post('/jornada/{jornada}/empleados', 'JornadaController@agregarEmpleados');
Route::delete('/jornada/{jornada}/empleados', 'JornadaController@removerEmpleados');

Route::resource('jornada', 'JornadaController');

Route::resource('ficha', 'FichaController');

Route::resource('cliente', 'ClienteController');

Route::resource('reporte', 'ReporteController', ['only' => ['create', 'store']]);

Route::get('/password/update', 'PasswordController@update');
Route::post('/password/save', 'PasswordController@save');
