<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['guest'])->group(function () {
    Route::get('login/{nroDoc}/{pass}', 'UsuariosController@inicioSesion');
    Route::get('validarToken/{tiempoToken}', 'UsuariosController@validarToken');
});

//Rutas de usuario
Route::post('usuarios/crear', 'UsuariosController@create');
Route::get('usuarios/listar', 'UsuariosController@show');
Route::get('usuarios/{creador}', 'UsuariosController@usuarios_creador');

//Rutas de cuentas
Route::get('cuentas/listar', 'CuentasController@show');
Route::get('cuentas/listar/{idUsuario}', 'CuentasController@getUserAccounts');
Route::post('cuentas/filter', 'CuentasController@filter');
Route::get('cuentas/listar-estadistica', 'CuentasController@listarEstadistica');
Route::post('cuentas/crear', 'CuentasController@create');
Route::put('cuentas/consignar', 'CuentasController@update');
Route::put('cuentas/retirar', 'CuentasController@retirarCuenta');
Route::put('cuentas/cancelar', 'CuentasController@cancelar');


//Rutas de movimientos
Route::get('movimientos/listar/{cuenta}', 'TransaccionController@show');
Route::post('movimientos/filter', 'TransaccionController@filter');
Route::get('movimientos/listar-estadistica', 'TransaccionController@listarEstadistica');
