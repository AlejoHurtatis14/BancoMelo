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

//Rutas de cuentas
Route::get('cuentas/listar', 'CuentasController@show');

//Rutas de movimientos
Route::get('movimientos/listar/{cuenta}', 'TransaccionController@show');
