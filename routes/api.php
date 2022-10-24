<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KirimController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProdukController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\OrderDetailController;

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
//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    // Route::resource('product', ProdukController::class);
    // Route::resource('kategori', KategoriController::class);
    // Route::resource('kirim', KirimController::class);
    // Route::resource('order', OrderController::class);
    // Route::resource('orderdetail', OrderDetailController::class);
    // // API route for logout user
    // Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/products', [ProdukController::class, 'index']);
Route::post('/products/store', [ProdukController::class, 'store']);
Route::get('/products/edit/{id}', [ProdukController::class, 'show']);
Route::post('/products/update/{id}', [ProdukController::class, 'update']);
Route::post('/products/{id}', [ProdukController::class, 'destroy']);

Route::get('/categories', [KategoriController::class, 'index']);
Route::post('/categories/store', [KategoriController::class, 'store']);
Route::post('/categories/{id}', [KategoriController::class, 'destroy']);

Route::get('/kirims', [KirimController::class, 'index']);

Route::get('/ordered', [OrderDetailController::class, 'store']);