<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
# Rutas generales
Route::get('/', function () { return view('login'); });
Route::post('login', 'UsersController@login');
Route::get('logout', 'UsersController@logout');
Route::get('dashboard', 'UsersController@dashboard');
# Rutas para el usuario administrador
Route::resource('admin/usuarios','UsersController');
Route::resource('admin/productos','ProductController');
# Rutas para el usuario de ventas
Route::get('ventas/verificar_sesion', 'SalesController@verificarSesion');
Route::get('ventas/punto_de_venta', 'SalesController@index');
Route::get('ventas/caja/aperturar', 'SalesController@aperturarSesion');
Route::resource('ventas/sesion','SessionsController');
