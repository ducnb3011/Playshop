<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\HomeController;

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
// Frontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');




//Backend 
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

//Category product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@addCategoryProduct');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@editCategoryProduct');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@deleteCategoryProduct');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@allCategoryProduct');
Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactiveCategoryProduct');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@activeCategoryProduct');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@saveCategoryProduct');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@updateCategoryProduct');

//Brand product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@addBrandProduct');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@editBrandProduct');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@deleteBrandProduct');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@allBrandProduct');

Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactiveBrandProduct');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@activeBrandProduct');

Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@saveBrandProduct');
Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@updateBrandProduct');
