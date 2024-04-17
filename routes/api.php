<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ShoppingCartController;

use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Admin\UserController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'getAll']);
    Route::get('/categories/{id}', [CategoryController::class, 'get']);
    Route::post('/categories/{id}', [CategoryController::class, 'delete']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::post('/categories', [CategoryController::class, 'create']); 
    Route::get('/users/getall', [UserController::class, 'getAll']);
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/delete/{id}',[UserController::class, 'delete']);
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/user/change-account-status/{id}', [UserController::class, 'lock']);
 
});

Route::prefix('customer')->group(function () {

    Route::get('/cart/{id}', [CartController::class, 'getProductById']);
    Route::get('/cart/plus/{id}', [CartController::class, 'plus']);
    Route::get('/cart/minus/{id}', [CartController::class, 'minus']);
    Route::get('/cart/delete/{id}', [CartController::class, 'deleteFromCart']);

    Route::get('/product/getAll', [ProductController::class, 'getAll']);
    Route::get('/product/getByCategory/{id?}', [ProductController::class, 'getByCategory']);
    Route::get('/listCategory', [CategoryController::class, 'getAll']);


});
