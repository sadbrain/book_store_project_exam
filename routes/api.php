<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Customer\ProductController;


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
Route::prefix('admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'getAll']);
    Route::get('/categories/{id}', [CategoryController::class, 'get']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::post('/categories', [CategoryController::class, 'create']);
});

Route::prefix('customer')->group(function () {
    Route::get('/product/getAll', [ProductController::class, 'getAll']);
    Route::get('/product/getByCategory/{id?}', [ProductController::class, 'getByCategory']);
    Route::get('/listProduct', [ProductController::class, 'showProduct']);
    Route::get('/listCategory', [CategoryController::class, 'getAll']);

});
