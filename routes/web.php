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

Route::get('/', 'Auth\LoginController@showLoginForm');

// @Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/admin/{admin}/enable', 'AdminController@enable');
Route::post('/admin/{admin}/disable', 'AdminController@disable');
Route::resource('admin', 'AdminController');

Route::post('/empleado/{empleado}/enable', 'EmpleadoController@enable');
Route::post('/empleado/{empleado}/disable', 'EmpleadoController@disable');
Route::get('/empleado/{empleado}/historial', 'EmpleadoController@historial');

Route::get('/empleado/{empleado}/jornada/extras/iniciar', 'EmpleadoController@showFormIniciarHorasExtras');
Route::post('/empleado/{empleado}/jornada/extras/iniciar', 'EmpleadoController@iniciarHorasExtras');
Route::get('/empleado/{empleado}/jornada/extras/finalizar', 'EmpleadoController@showFormFinalizarHorasExtras');
Route::post('/empleado/{empleado}/jornada/extras/finalizar', 'EmpleadoController@finalizarHorasExtras');

Route::get('/empleado/{empleado}/jornada/descanso/iniciar', 'EmpleadoController@showFormIniciarDescanso');
Route::post('/empleado/{empleado}/jornada/descanso/iniciar', 'EmpleadoController@iniciarDescanso');
Route::get('/empleado/{empleado}/jornada/descanso/finalizar', 'EmpleadoController@showFormFinalizarDescanso');
Route::post('/empleado/{empleado}/jornada/descanso/finalizar', 'EmpleadoController@finalizarDescanso');

Route::get('/empleado/{empleado}/jornada/iniciar', 'EmpleadoController@showFormIniciarJornada');
Route::post('/empleado/{empleado}/jornada/iniciar', 'EmpleadoController@iniciarJornada');
Route::get('/empleado/{empleado}/jornada/finalizar', 'EmpleadoController@showFormFinalizarJornada');
Route::post('/empleado/{empleado}/jornada/finalizar', 'EmpleadoController@finalizarJornada');

Route::resource('empleado', 'EmpleadoController');
Route::post('/empleado/{provincia}/poblacion', 'EmpleadoController@poblacion');

Route::post('/jornada/{jornada}/enable', 'JornadaController@enable');
Route::post('/jornada/{jornada}/disable', 'JornadaController@disable');
Route::get('/jornada/{jornada}/empleados', 'JornadaController@empleados');
Route::post('/jornada/{jornada}/empleados', 'JornadaController@agregarEmpleados');
Route::delete('/jornada/{jornada}/empleados', 'JornadaController@removerEmpleados');

Route::resource('jornada', 'JornadaController');

Route::resource('ficha', 'FichaController');

Route::resource('cliente', 'ClienteController');

Route::resource('empresa', 'EmpresaController');

Route::get('/reporte/cliente',    'ReporteController@showFormReporteCliente');
Route::get('/reporte/clientes',   'ReporteController@showFormReporteClientes');
Route::get('/reporte/empleado',   'ReporteController@showFormReporteEmpleado');
Route::get('/reporte/empleados',  'ReporteController@showFormReporteEmpleados');
Route::post('/reporte/cliente',   'ReporteController@reporteCliente');
Route::post('/reporte/clientes',  'ReporteController@reporteClientes');
Route::post('/reporte/empleado',  'ReporteController@reporteEmpleado');
Route::post('/reporte/empleados', 'ReporteController@reporteEmpleados');
Route::resource('reporte', 'ReporteController', ['only' => ['index', 'create', 'store']]);

Route::get('/password/update', 'PasswordController@update');
Route::post('/password/save', 'PasswordController@save');
