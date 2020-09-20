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

//Pondok
Route::get('/pondok', 'Admin\PondokController@index')->name('pondok')->middleware('verified');
Route::get('/pondok/datatables', 'Admin\PondokController@datatables')->middleware('verified');
Route::get('/pondok/{id}', 'Admin\PondokController@getById')->name('pondok_singular')->middleware('verified');
Route::post('/pondok', 'Admin\PondokController@createUpdate')->middleware('verified');
Route::post('/pondok/destroy', 'Admin\PondokController@destroy')->name('pondok_destroy')->middleware('verified');

//Pengguna
Route::get('/pengguna', 'Admin\PenggunaController@index')->name('pengguna')->middleware('verified');
Route::get('/pengguna/datatables', 'Admin\PenggunaController@datatables')->middleware('verified');

Route::get('/kas', 'Admin\CashController@index')->name('kas')->middleware('verified');
