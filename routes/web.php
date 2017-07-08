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
Route::resource('admin', 'AdminController');
Route::resource('empleado', 'EmpleadoController');
Route::resource('ficha', 'FichaController');
Route::resource('jornada', 'JornadaController');
Route::resource('cliente', 'ClienteController');
Route::resource('reporte', 'ReporteController', ['only' => ['create', 'store']]);
Route::get('/password/update', 'PasswordController@update');
Route::post('/password/save', 'PasswordController@save');
