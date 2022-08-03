<?php

use App\Http\Controllers\FrontendApisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/category', [FrontendApisController::class, 'get_category_api'])->name('get_category_api');
Route::post('/users', [FrontendApisController::class, 'store_user'])->name('store_user');
Route::post('/myaccount/{id}', [FrontendApisController::class, 'myaccount'])->name('myaccount');
Route::post('/login', [FrontendApisController::class, 'login'])->name('login');
Route::get('/products', [FrontendApisController::class, 'get_products_api'])->name('get_products_api');
Route::get('/product-page', [FrontendApisController::class, 'get_page_products'])->name('get_page_products');
Route::get('/category/{id}', [FrontendApisController::class, 'get_subcategory'])->name('get_subcategory');
Route::get('/subcategory/{id}', [FrontendApisController::class, 'get_products_by_subcat'])->name('get_products_by_subcat');
Route::get('/subcategory-data/{id}', [FrontendApisController::class, 'get_single_subcategory'])->name('get_single_subcategory');
Route::get('/category-data/{id}', [FrontendApisController::class, 'get_single_category'])->name('get_single_category');
Route::get('/category-products/{id}', [FrontendApisController::class, 'get_category_products'])->name('get_category_products');
Route::get('/get-category/{id}', [FrontendApisController::class, 'get_category_by_subcategory'])->name('get_category_by_subcategory');
Route::post('/user', [FrontendApisController::class, 'get_user'])->name('get_user');
Route::post('/login-user', [FrontendApisController::class, 'getAuthUser'])->name('getAuthUser');
Route::get('/subcategory', [FrontendApisController::class, 'get_all_subcategories'])->name('get_all_subcategories');
Route::get('/products/{key}', [FrontendApisController::class, 'product_sorting'])->name('product_sorting');
Route::get('/sub-products/{key}/{id}', [FrontendApisController::class, 'sortbysubcat'])->name('sortbysubcat');
Route::get('/cat-products/{key}/{id}', [FrontendApisController::class, 'sortbycat'])->name('sortbycat');

// Route::post('/addItemsToCart', [CartController::class, 'addItemsToCart'])->name('addItemsToCart');
// Route::get('/getCartData/{id}', [CartController::class, 'getCartData'])->name('getCartData');
// Route::get('/getCartDetails/{id}', [CartController::class, 'getCartDetails'])->name('getCartDetails');

Route::post('/order-store', [FrontendApisController::class, 'order_store'])->name('order_store');
Route::get('/setting-data', [FrontendApisController::class, 'setting_data'])->name('setting_data');