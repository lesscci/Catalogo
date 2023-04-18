<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InfUserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Registro
Route::post('/register',[AuthController::class, 'register']);
//Login
Route::post('/login', [AuthController::class,'login']);

//infUser
Route::post('/infUser', [AuthController::class,'infUser'])->Middleware('auth:sanctum');
Route::post('/logout', [AuthController::class,'logout']);

//Ruta controlador de Productos
Route::resource('productos', 'App\Http\Controllers\Api\ProductoController');
//PROVEEDORES   
Route::resource('proveedores', 'App\Http\Controllers\Api\ProveedorController');


Route::get('/api/productos/{id}', [ProductoController::class, 'show']);



