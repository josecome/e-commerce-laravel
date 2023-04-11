<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;

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
Route::get('/',[CategoryController::class,'getCategories'])->name('home');
Route::get('/product/{category}',[ProductController::class, 'getProducts']
)->middleware('auth')->name('product');
Route::get('/product_form',[ProductController::class, 'addNewProductForm']
)->middleware('auth')->name('product_form');
Route::post('/add_product',[ProductController::class, 'addNewProduct']
)->middleware('auth')->name('add_product');
Route::post('/add_category',[CategoryController::class, 'addNewCategory']
)->middleware('auth')->name('add_category');
Route::get('/products_for_sale/{category}',[ProductController::class, 'ProductsForSale']
)->name('products_for_sale');
Route::get('/products_for_sale_list/{category}',[ProductController::class, 'ProductsForSaleList']
)->name('products_for_sale_list');

Route::post('/add_product_in_cart', [CartController::class, 'addNewProductInCart']
)->middleware('auth')->name('add_product_in_cart');

Route::get('/productincart/{userid}', [CartController::class, 'getProductsInCart']
)->middleware('auth')->name('productincart');

Route::middleware('auth')->group(function () {
    Route::patch('/cartupdate/{itemid}', [CartController::class, 'cartUpdate'])->name('cartupdate');
    Route::delete('/delete_item_in_cart/{id}', [CartController::class, 'deleteItemInCart']
    )->name('delete_item_in_cart');

});

Route::patch('/payment', [CartController::class, 'Paid']
)->middleware(['auth', 'limit.purchase.for.user.18'])->name('payment');

Route::get('/add_successfull', function () {
    return view('add_successfull');
});

Route::get('/limit_purchase_for_age_under_18', function () {
    return view('limit_purchase_for_age_under_18');
});

Route::get('/logout',[Controllers::class,'logout']);

Route::get('/dashboard', function (Request $req) {
    //$req->session()->put('user', $user);
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
