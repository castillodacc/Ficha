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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/admin/{admin}/enable', 'AdminController@enable');
Route::post('/admin/{admin}/disable', 'AdminController@disable');
Route::resource('admin', 'AdminController');

Route::post('/admin/{admin}/enable', 'AdminController@enable');
Route::post('/admin/{admin}/disable', 'AdminController@disable');
Route::resource('empleado', 'EmpleadoController');

Route::post('/jornada/{jornada}/enable', 'JornadaController@enable');
Route::post('/jornada/{jornada}/disable', 'JornadaController@disable');
Route::resource('jornada', 'JornadaController');

Route::resource('ficha', 'FichaController');

Route::resource('cliente', 'ClienteController');

Route::resource('reporte', 'ReporteController', ['only' => ['create', 'store']]);

Route::get('/password/update', 'PasswordController@update');
Route::post('/password/save', 'PasswordController@save');
