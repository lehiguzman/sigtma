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
    return view('auth.login');
});

Auth::routes();

//Vista que se llama al hacer login contenido/contenido.blade.php, esta vista extiende al home
Route::get('/main', function () {
    return view('contenido/contenido');
	})->name('main');

Route::get('/home', 'HomeController@index')->name('home');

//Rol
Route::get('/rol', 'RolController@index');
Route::get('/rol/selectRol', 'RolController@selectRol');

//Usuarios
Route::get('/user', 'UserController@index');
Route::post('/user/registrar', 'UserController@store');
Route::put('/user/actualizar', 'UserController@update');
Route::delete('/user/eliminar/{id}', 'UserController@destroy');

//tipos_contribuyente_comercio
Route::get('/tipo_comercio', 'TipoComercioController@index');
Route::post('/tipo_comercio/registrar', 'TipoComercioController@store');
Route::put('/tipo_comercio/actualizar', 'TipoComercioController@update');
Route::delete('/tipo_comercio/eliminar/{id}', 'TipoComercioController@destroy');

//tipos_contribuyente_inmueble
Route::get('/tipo_inmueble', 'TipoInmuebleController@index');
Route::post('/tipo_inmueble/registrar', 'TipoInmuebleController@store');
Route::put('/tipo_inmueble/actualizar', 'TipoInmuebleController@update');
Route::delete('/tipo_inmueble/eliminar/{id}', 'TipoInmuebleController@destroy');

//tipos_contribuyente_vehiculo
Route::get('/tipo_vehiculo', 'TipoVehiculoController@index');
Route::post('/tipo_vehiculo/registrar', 'TipoVehiculoController@store');
Route::put('/tipo_vehiculo/actualizar', 'TipoVehiculoController@update');
Route::delete('/tipo_vehiculo/eliminar/{id}', 'TipoVehiculoController@destroy');

//comercios
Route::get('/comercio', 'ComercioController@index');
Route::post('/comercio/registrar', 'ComercioController@store');
Route::put('/comercio/actualizar', 'ComercioController@update');
Route::delete('/comercio/eliminar/{id}', 'ComercioController@destroy');
Route::get('/tipos_comercio/{id}', 'ComercioController@tipos');

//inmuebles
Route::get('/inmueble', 'InmuebleController@index');
Route::post('/inmueble/registrar', 'InmuebleController@store');
Route::put('/inmueble/actualizar', 'InmuebleController@update');
Route::delete('/inmueble/eliminar/{id}', 'InmuebleController@destroy');

//vehiculos
Route::get('/vehiculo', 'VehiculoController@index');
Route::post('/vehiculo/registrar', 'VehiculoController@store');
Route::put('/vehiculo/actualizar', 'VehiculoController@update');
Route::delete('/vehiculo/eliminar/{id}', 'VehiculoController@destroy');

//periodos
Route::get('/periodo', 'PeriodoController@index');
Route::post('/periodo/registrar', 'PeriodoController@store');
Route::put('/periodo/actualizar', 'PeriodoController@update');
Route::delete('/periodo/eliminar/{id}', 'PeriodoController@destroy');

//zonas
Route::get('/zona', 'ZonaController@index');
Route::post('/zona/registrar', 'ZonaController@store');
Route::put('/zona/actualizar', 'ZonaController@update');
Route::delete('/zona/eliminar/{id}', 'ZonaController@destroy');

//regimen
Route::get('/regimen', 'RegimenController@index');
Route::post('/regimen/registrar', 'RegimenController@store');
Route::put('/regimen/actualizar', 'RegimenController@update');
Route::delete('/regimen/eliminar/{id}', 'RegimenController@destroy');

//declaraciones Comercio
Route::get('/declaracion_comercio', 'DeclaracionComercioController@index');
Route::post('/declaracion_comercio/registrar', 'DeclaracionComercioController@store');
Route::delete('/declaracion_comercio/eliminar/{id}', 'DeclaracionComercioController@destroy');
Route::get('/declaracion_comercio/{id}', 'DeclaracionComercioController@selectDeclaracionComercio');

Route::get('/declaracion/{id}', 'DeclaracionComercioController@selectDeclaracion');

//declaraciones Inmuebles
Route::get('/declaracion_inmueble', 'DeclaracionInmuebleController@index');
Route::post('/declaracion_inmueble/registrar', 'DeclaracionInmuebleController@store');
Route::delete('/declaracion_inmueble/eliminar/{id}', 'DeclaracionInmuebleController@destroy');
Route::get('/declaracion_inmueble/{id}', 'DeclaracionInmuebleController@selectDeclaracion');
Route::get('/impuesto_inmueble/{id}', 'DeclaracionInmuebleController@selectDeclaracionInmueble');

//declaraciones Vehiculos
Route::get('/declaracion_vehiculo', 'DeclaracionVehiculoController@index');
Route::post('/declaracion_vehiculo/registrar', 'DeclaracionVehiculoController@store');
Route::delete('/declaracion_vehiculo/eliminar/{id}', 'DeclaracionVehiculoController@destroy');
Route::get('/declaracion_vehiculo/{id}', 'DeclaracionVehiculoController@selectDeclaracion');
Route::get('/impuesto_vehiculo/{id}', 'DeclaracionVehiculoController@selectDeclaracionVehiculo');

//pagos
Route::get('/pago', 'PagoController@index');
Route::post('/pago/registrar', 'PagoController@store');
Route::delete('/pago/eliminar/{id}', 'PagoController@destroy');

//Historico de pagos
Route::get('/historico_comercio/{id}', 'ComercioController@historico');
Route::get('/historico_inmueble/{id}', 'InmuebleController@historico');
Route::get('/historico_vehiculo/{id}', 'VehiculoController@historico');

//Reportes
Route::get('/reportePagos', 'PagoController@reportePagos');
Route::get('/bitacora', 'PagoController@bitacora');
Route::get('/edoCtaComercio', 'DeclaracionComercioController@edoCtaComercio');
Route::get('/edoCtaInmueble', 'DeclaracionInmuebleController@edoCtaInmueble');
Route::get('/edoCtaVehiculo', 'DeclaracionVehiculoController@edoCtaVehiculo');

//Listado
Route::get('/tipoComercio/listarTipoComercio', 'TipoComercioController@listarTipoComercio');

