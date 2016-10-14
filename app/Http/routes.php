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
Route::get('perfil', 'UsersController@mostrarPerfil');
Route::post('perfil_config', 'UsersController@guardarPass');
# Rutas para el usuario administrador
Route::resource('admin/usuarios','UsersController');
Route::resource('admin/productos','ProductController');
Route::resource('admin/business_config','BusinessConfigController');
Route::get('admin/anulacion', 'SalesController@anulacion');
Route::get('admin/mostrar_venta', 'SalesController@mostrarVenta');
Route::post('admin/anular', 'SalesController@anularVenta');
Route::post('admin/producto/actualizar/{id_producto}', 'ProductController@update');
Route::resource('admin/categorias','CategoryController');
Route::get('admin/reportes/listado','ReportsAdminController@listadoReportes');
Route::get('admin/reportes/ventas/filtrar','ReportsAdminController@filtrarReporteVentas');
Route::post('admin/reportes/ventas/generar','ReportsAdminController@generarReporteVentas');
# Rutas para el usuario de ventas
Route::get('ventas/verificar_sesion', 'SalesController@verificarSesion');
Route::get('ventas/punto_de_venta', 'SalesController@index');
Route::get('ventas/caja/aperturar', 'SalesController@aperturarSesion');
Route::resource('ventas/sesion','SessionsController');
Route::get('ventas/productos', 'ProductController@index');
Route::get('ventas/productos/filtrar/{filtro?}', 'ProductController@filtrar');
Route::post('ventas/punto_de_venta/guardar', 'SalesController@guardar');
Route::get('ventas/punto_de_venta/ticket/{id_venta}', 'SalesController@imprimirTicket');
Route::get('ventas/caja/cierre', 'SessionsController@cerraCaja');
Route::post('ventas/cerrar', 'SessionsController@confimarCierre');
Route::get('ventas/resumen_sesion/{id_sesion}', 'SessionsController@resumenCaja');
Route::get('ventas/punto_de_venta/cliente/{numero_documento?}', 'SalesController@recuperarCliente');
Route::get('ventas/resumen_ventas', 'SalesController@resumenVentas');
Route::get('ventas/detalle/{id_venta}', 'SalesController@detalleVentas');
Route::get('ventas/categorias', 'CategoryController@categoriasParaVentas');
