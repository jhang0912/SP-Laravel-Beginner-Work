<?php

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

/* 會員註冊 */
Route::post('register', 'App\Http\Controllers\Member@register');

/* 會員登入 */
Route::post('signIn', 'App\Http\Controllers\Member@signIn');

/* 會員授權操作 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('signOut', 'App\Http\Controllers\Member@signOut'); //會員登出
    Route::post('member', 'App\Http\Controllers\Member@member'); //取得會員資料
    Route::get('Cart', 'App\Http\Controllers\CartController@addProductsToCart'); //將商品放進購物車
});
