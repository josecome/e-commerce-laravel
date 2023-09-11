<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    //return $request->user();
    return 'loggedin';
});

Route::middleware('cors')->group(function () {
    Route::get('/', [ApiController::class, 'getCategories'])->name('home');
    Route::get(
        '/listofcategories',
        [ApiController::class, 'getListCategories']
    )->name('listofcategories');
    Route::get(
        '/product/{category}',
        [ApiController::class, 'getProducts']
    )->name('product');
    Route::get(
        '/products_for_sale/{category}',
        [ApiController::class, 'getProducts']
    )->name('products_for_sale');
    Route::get(
        '/productincart/{userid}',
        [ApiController::class, 'getProductsInCart']
    )->name('productincart');
    Route::post(
        '/add_product',
        [ApiController::class, 'addNewProduct']
    )->name('add_product');
});

Route::post('/register', [UserApiController::class, 'register'])->name('register');
Route::post('/login', [UserApiController::class, 'login'])->name('login');
Route::post('/logout', [UserApiController::class, 'logout'])->name('logout');
