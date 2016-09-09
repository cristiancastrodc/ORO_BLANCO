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
# Rutas para el administrador
Route::resource('admin/usuarios','UsersController');
Route::resource('admin/productos','ProductController');
