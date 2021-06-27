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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index'])->middleware(['auth'])->name('category');
Route::get('/create-category', [\App\Http\Controllers\CategoryController::class, 'createCategory'])->middleware(['auth']);
Route::get('/edit-category/{id}', [\App\Http\Controllers\CategoryController::class, 'editCategory'])->middleware(['auth']);
Route::delete('/delete-category/{id}', [\App\Http\Controllers\CategoryController::class, 'delCategory'])->middleware(['auth']);
Route::post('/create/check', [\App\Http\Controllers\CategoryController::class, 'createCategory_check'])->middleware(['auth']);
Route::post('/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->middleware(['auth'])->middleware(['auth']);

Route::get('/product', [\App\Http\Controllers\ProductController::class, 'product'])->middleware(['auth'])->name('product');
Route::get('/create-product', [\App\Http\Controllers\ProductController::class, 'createProduct'])->middleware(['auth']);
Route::get('/edit-product/{id}',[\App\Http\Controllers\ProductController::class, 'editProduct'])->middleware(['auth']);
Route::delete('delete-product/{id}', [\App\Http\Controllers\ProductController::class, 'delProduct'])->middleware(['auth']);
Route::post('/create/check_product', [\App\Http\Controllers\ProductController::class, 'createProduct_check'])->middleware(['auth']);
Route::post('/edit-product/{id}', [\App\Http\Controllers\ProductController::class, 'editProduct'])->middleware(['auth']);

require __DIR__.'/auth.php';
