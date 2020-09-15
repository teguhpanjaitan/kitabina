<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('default.frontend.home');
});
Route::get('/order', 'Guest\OrderController@index')->name('order');

Auth::routes(['verify' => true]);
Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard')->middleware('verified');
//Product
Route::get('/product', 'Admin\ProductController@index')->name('product')->middleware('verified');
Route::get('/product/datatables', 'Admin\ProductController@datatables')->middleware('verified');
Route::get('/product/{id}', 'Admin\ProductController@getById')->name('product_singular')->middleware('verified');
Route::post('/product', 'Admin\ProductController@createUpdate')->middleware('verified');
Route::post('/product/destroy', 'Admin\ProductController@destroy')->name('product_destroy')->middleware('verified');
//Stock
Route::get('/stock', 'Admin\StockController@index')->name('stock')->middleware('verified');
Route::get('/stock/datatables', 'Admin\StockController@datatables')->middleware('verified');
Route::get('/stock/{id}', 'Admin\StockController@getById')->name('stock_singular')->middleware('verified');
Route::post('/stock', 'Admin\StockController@createUpdate')->middleware('verified');
Route::post('/stock/destroy', 'Admin\StockController@destroy')->name('stock_destroy')->middleware('verified');
Route::get('/order', 'Admin\OrderController@index')->name('order')->middleware('verified');
