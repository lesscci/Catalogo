<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

/**
 * Transaciones
 */
Route::resource('transactions', 'App\Http\Controllers\Transaction\TransactionController', ['only' => ['index', 'show']]);
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