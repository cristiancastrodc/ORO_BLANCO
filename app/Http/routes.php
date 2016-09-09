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
Route::get('/', function () {
    return view('login');
});
Route::post('login', function() {
  if (Auth::attempt(['user' => $request['tbUsuario'], 'password' => $request['tbPassword']])) {
    return "Logged in.";
  } else {
    return "Failed login.";
  }
});
# Rutas para el administrador
Route::resource('admin/usuarios','UsersController');
