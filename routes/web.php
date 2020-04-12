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

//zonas
Route::get('/regimen', 'RegimenController@index');
Route::post('/regimen/registrar', 'RegimenController@store');
Route::put('/regimen/actualizar', 'RegimenController@update');
Route::delete('/regimen/eliminar/{id}', 'RegimenController@destroy');

//declaraciones
Route::get('/declaracion_comercio', 'DeclaracionComercioController@index');
Route::post('/declaracion_comercio/registrar', 'DeclaracionComercioController@store');
Route::delete('/declaracion_comercio/eliminar/{id}', 'DeclaracionComercioController@destroy');
Route::get('/declaracion_comercio/{id}', 'DeclaracionComercioController@selectDeclaracion');

