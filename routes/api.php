<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Registro
Route::post('/register',[AuthController::class, 'register']);
//Login
Route::post('/login', [AuthController::class,'login']);

//infUser
Route::post('/infUser', [AuthController::class,'infUser'])->Middleware('auth:sanctum');
//Ruta controlador de Productos
Route::resource('productos', 'App\Http\Controllers\Api\ProductoController');
//PROVEEDORES   
Route::resource('proveedores', 'App\Http\Controllers\Api\ProveedorController');


Route::put('/user', 'InfUserController@update')->middleware('auth:sanctum');

