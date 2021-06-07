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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);

Route::get('/create-category', [\App\Http\Controllers\MainController::class, 'createCategory']);
Route::get('/edit-category/{id}', [\App\Http\Controllers\MainController::class, 'editCategory']);
Route::delete('/delete-category/{id}', [\App\Http\Controllers\MainController::class, 'delCategory']);
Route::post('/create/check', [\App\Http\Controllers\MainController::class, 'createCategory_check']);
