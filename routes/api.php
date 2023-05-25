<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cart\CartController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
Compradores
*/
Route::resource('buyers', 'App\Http\Controllers\Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::resource('buyers.transactions', 'App\Http\Controllers\Buyer\BuyerTransactionController', ['only' => ['index']]);
Route::resource('buyers.products', 'App\Http\Controllers\Buyer\BuyerProductController', ['only' => ['index']]);
Route::resource('buyers.sellers', 'App\Http\Controllers\Buyer\BuyerSellerController', ['only' => ['index']]);
Route::resource('buyers.categories', 'App\Http\Controllers\Buyer\BuyerCategoryController', ['only' => ['index']]);

/**
 * Categorias
 */
Route::resource('categories', 'App\Http\Controllers\Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.products', 'App\Http\Controllers\Category\CategoryProductController', ['only' => ['index']]);
Route::resource('categories.sellers', 'App\Http\Controllers\Category\CategorySellerController', ['only' => ['index']]);
Route::resource('categories.transactions', 'App\Http\Controllers\Category\CategoryTransactionController', ['only' => ['index']]);
Route::resource('categories.buyers', 'App\Http\Controllers\Category\CategoryBuyerController', ['only' => ['index']]);


/**
 * Productos
 */
Route::resource('products', 'App\Http\Controllers\Product\ProductController', ['only' => ['index', 'show']]);
Route::resource('products.transactions', 'App\Http\Controllers\Product\ProductTransactionController', ['only' => ['index']]);

/**
 * Transaciones
 */
Route::resource('transactions', 'App\Http\Controllers\Transaction\TransactionController', ['only' => ['index', 'show', 'store']]);
Route::resource('transactions.categories', 'App\Http\Controllers\Transaction\TransactionCategoryController', ['only' => ['index']]);
Route::resource('transactions.sellers', 'App\Http\Controllers\Transaction\TransactionSellerController', ['only' => ['index']]);

/**
 * Sellers
 */
Route::resource('sellers', 'App\Http\Controllers\Seller\SellerController', ['only' => ['index', 'show']]);

/**
 * Usuarios
 */
Route::resource('users', 'App\Http\Controllers\User\UserController', ['except' => ['create', 'edit']]);
//Registro
Route::post('/register',[AuthController::class, 'register']);
//Login
Route::post('/login', [AuthController::class,'login']);

//infUser
Route::post('/infUser', [AuthController::class,'infUser'])->Middleware('auth:sanctum');
Route::post('/logout', [AuthController::class,'logout']);

/**
 * CART
 */

// Route::resource('carts', 'App\Http\Controllers\Cart\CartController', ['only' => ['store', 'show']]);
//Route::resource('carts.products', 'App\Http\Controllers\Cart\CartProductController', ['only' => ['store', 'destroy']]);

Route::post('/carts/add', [CartController::class, 'addToCart']);
Route::delete('/carts/remove', [CartController::class, 'removeFromCart']);


//Registro
Route::post('/register',[AuthController::class, 'register']);
//Login
Route::post('/login', [AuthController::class,'login']);
//infUser
Route::post('/infUser', [AuthController::class,'infUser'])->Middleware('auth:sanctum');
Route::post('/logout', [AuthController::class,'logout']);


//Ruta controlador de Productos
//PROVEEDORES   
Route::resource('proveedores', 'App\Http\Controllers\Api\ProveedorController');





// Rutas para el controlador de Proveedor
Route::get('/proveedores', [App\Http\Controllers\Api\ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/create', [App\Http\Controllers\Api\ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [App\Http\Controllers\Api\ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}', [App\Http\Controllers\Api\ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/{proveedor}/edit', [App\Http\Controllers\Api\ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedor}', [App\Http\Controllers\Api\ProveedorController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{proveedor}', [App\Http\Controllers\Api\ProveedorController::class, 'destroy'])->name('proveedores.destroy');
