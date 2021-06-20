<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/home', function () {
    return view('home');
});*/

Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index']);

Route::get('/create-category', [\App\Http\Controllers\CategoryController::class, 'createCategory']);
Route::get('/edit-category/{id}', [\App\Http\Controllers\CategoryController::class, 'editCategory']);
Route::delete('/delete-category/{id}', [\App\Http\Controllers\CategoryController::class, 'delCategory']);
Route::post('/create/check', [\App\Http\Controllers\CategoryController::class, 'createCategory_check']);
Route::post('/edit', [\App\Http\Controllers\CategoryController::class, 'edit']);

Route::get('/product', [\App\Http\Controllers\ProductController::class, 'product']);
Route::get('/create-product', [\App\Http\Controllers\ProductController::class, 'createProduct']);
Route::get('/edit-product/{id}',[\App\Http\Controllers\ProductController::class, 'editProduct']);
Route::delete('delete-product/{id}', [\App\Http\Controllers\ProductController::class, 'delProduct']);
Route::post('/create/check_product', [\App\Http\Controllers\ProductController::class, 'createProduct_check']);
Route::post('/edit-product/{id}', [\App\Http\Controllers\ProductController::class, 'editProduct']);
