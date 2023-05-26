<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\Api\InfUserController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ProveedorController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registro
Route::post('/register', [AuthController::class, 'register']);
// Login
Route::post('/login', [AuthController::class, 'login']);

// infUser
Route::post('/infUser', [InfUserController::class, 'infUser'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout']);

// Rutas controlador de Productos
Route::resource('productos', ProductoController::class);

// Rutas controlador de Proveedores
Route::resource('proveedores', ProveedorController::class);

Route::get('/api/productos/{id}', [ProductoController::class, 'show']);

Route::resource('purcharses', PurchasesController::class);


