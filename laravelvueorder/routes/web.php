<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\DevguideController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserValidAuth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::any('/', [AuthController::class, 'login'])->name('login');
Route::post('/ajaxlogin', [AuthController::class, 'ajaxlogin'])->name('ajaxlogin');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/', [UserController::class, 'index'])->name('dashboard');
Route::get('/user_profile_form_popup', [UserController::class, 'user_profile_form_popup'])->name('user_profile_form_popup');
Route::post('/ajax_save_user_profile', [UserController::class, 'ajax_save_user_profile'])->name('ajax_save_user_profile');
Route::post('/ajax_check_admin_password', [UserController::class, 'ajax_check_admin_password'])->name('ajax_check_admin_password');
Route::post('/ajax_check_users_email', [UserController::class, 'ajax_check_users_email'])->name('ajax_check_users_email');
Route::post('/ajax_check_user_name', [UserController::class, 'ajax_check_user_name'])->name('ajax_check_user_name');
Route::post('/admin_update_details', [UserController::class, 'admin_update_details'])->name('admin_update_details');


Route::middleware([UserValidAuth::class])->group(function () {
Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');

//User 
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/del_user', [UserController::class, 'deletemultiuser'])->name('del_user');
Route::get('/del_single_user/{id}', [UserController::class, 'del_single_user'])->name('del_single_user');
Route::get('/ajax_get_user_list', [UserController::class, 'ajax_get_user_list'])->name('ajax_get_user_list');
Route::post('/ajax_check_users_email', [UserController::class, 'ajax_check_users_email'])->name('ajax_check_users_email');
Route::get('/new-user', [UserController::class, 'save_user'])->name('new-user');
Route::post('/save_user', [UserController::class, 'save_user'])->name('save_user');
Route::get('/update_user/{id}', [UserController::class, 'save_user'])->name('update_user');
Route::post('/update_user/{id}', [UserController::class, 'save_user'])->name('update_user');
Route::get('/user_profile_form', [UserController::class, 'user_profile_form'])->name('user_profile_form');
Route::get('/ajax_get_user_data', [UserController::class, 'ajax_get_user_data'])->name('ajax_get_user_data');
Route::post('/ajax_save_user_profile', [UserController::class, 'ajax_save_user_profile'])->name('ajax_save_user_profile');
Route::post('/ajax_check_password', [UserController::class, 'ajax_check_password'])->name('ajax_check_password');

// category
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/del_category', [CategoryController::class, 'deletemulticategory'])->name('del_category');
Route::get('/del_single_category/{id}', [CategoryController::class, 'del_single_category'])->name('del_single_category');
Route::get('/ajax_get_category_list', [CategoryController::class, 'ajax_get_category_list'])->name('ajax_get_category_list');
Route::post('/ajax_check_category', [CategoryController::class, 'ajax_check_category'])->name('ajax_check_category');
Route::get('/new-category', [CategoryController::class, 'save_category'])->name('new-category');
Route::post('/save_category', [CategoryController::class, 'save_category'])->name('save_category');
Route::get('/update_category/{id}', [CategoryController::class, 'save_category'])->name('update_category');
Route::post('/update_category/{id}', [CategoryController::class, 'save_category'])->name('update_category');

//sub category
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories');
Route::post('/del_subcategory', [SubcategoryController::class, 'deletemultisubcategory'])->name('del_subcategory');
Route::get('/del_single_subcategory/{id}', [SubcategoryController::class, 'del_single_subcategory'])->name('del_single_subcategory');
Route::get('/ajax_get_subcategory_list', [SubcategoryController::class, 'ajax_get_subcategory_list'])->name('ajax_get_subcategory_list');
Route::post('/ajax_check_subcategory_by_category', [SubcategoryController::class, 'ajax_check_subcategory_by_category'])->name('ajax_check_subcategory_by_category');
Route::get('/new-subcategory', [SubcategoryController::class, 'save_subcategory'])->name('new-subcategory');
Route::post('/save_subcategory', [SubcategoryController::class, 'save_subcategory'])->name('save_subcategory');
Route::get('/update_subcategory/{id}', [SubcategoryController::class, 'save_subcategory'])->name('update_subcategory');
Route::post('/update_subcategory/{id}', [SubcategoryController::class, 'save_subcategory'])->name('update_subcategory');


//product
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/ajax_get_product_list', [ProductController::class, 'ajax_get_product_list'])->name('ajax_get_product_list');
Route::get('/save_product', [ProductController::class, 'save_product'])->name('save_product');
Route::post('/save_product', [ProductController::class, 'save_product'])->name('save_product');
Route::get('/update_product/{id}', [ProductController::class, 'save_product'])->name('update_product');
Route::post('/update_product/{id}', [ProductController::class, 'save_product'])->name('update_product');
Route::post('/ajax-subcategory', [ProductController::class, 'ajax_get_subcategory'])->name('ajax_subcategory');
Route::post('/del_product', [ProductController::class, 'deletemultiproduct'])->name('del_product');
Route::get('/del_single_product/{id}', [ProductController::class, 'del_single_product'])->name('del_single_product');
Route::post('/ajax_check_product_name', [ProductController::class, 'ajax_check_product_name'])->name('ajax_check_product_name');
Route::post('/ajax_check_sku_name', [ProductController::class, 'ajax_check_sku_name'])->name('ajax_check_sku_name');

//setting
Route::get('/setting', [SettingController::class, 'setting_update'])->name('setting_update');
Route::post('/change-setting', [SettingController::class, 'setting_update'])->name('setting_change');

//orders

Route::get('/orders', [CheckoutController::class, 'orders_view'])->name('orders');
Route::get('/ajax_get_order_list', [CheckoutController::class, 'ajax_get_order_list'])->name('ajax_get_order_list');
Route::get('/order_details_form_popup/{id}', [CheckoutController::class, 'order_details_form_popup'])->name('order_details_form_popup');


});