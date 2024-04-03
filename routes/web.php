<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Customer\CartController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get("/", [HomeController::class, "index"]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('/cart/summary', [CartController::class, 'summary']);
    Route::post('/cart/summary', [CartController::class, 'summaryPost']);
    Route::get('/cart/orderConfirmation/{id}', [CartController::class, 'orderConfirmation']);

});
Route::prefix('customer')->group(function () {
    Route::get('/detail/{id}', [HomeController::class, 'detail']);

});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/user/create', [UserController::class, 'register']);
    Route::post('/user/create', [UserController::class, 'registerPost']);
    Route::get('/users', [UserController::class, 'index']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/detail/{id}', [OrderController::class, 'detail']);
    Route::post('/order/detail', [OrderController::class, 'detailPost']);
    Route::post('/order/paynow', [OrderController::class, 'paynow']);
    Route::post('/order/startProcessing', [OrderController::class, 'startProcessing']);
    Route::post('/order/shipOrder', [OrderController::class, 'shipOrder']);
    Route::post('/order/cancelOrder', [OrderController::class, 'cancelOrder']);
    Route::get('/order/orderConfirmation/{id}', [OrderController::class, 'orderConfirmation']);

    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/getAll', [ProductController::class, 'getAll']);
    Route::get('/product/update/{id}', [ProductController::class, 'update']);
    Route::post('/product/update', [ProductController::class, 'updatePost']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/create', [ProductController::class, 'createPost']);
    Route::post('/product/delete/{id}', [ProductController::class, 'deletePost']);
});