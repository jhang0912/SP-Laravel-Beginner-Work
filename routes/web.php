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
Route::post('register', 'App\Http\Controllers\MemberController@register');

/* 會員登入 */
Route::post('signIn', 'App\Http\Controllers\MemberController@signIn');

/* 會員授權操作 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('cart', 'App\Http\Controllers\CartController@addProductsToCart'); //將商品放進購物車
    Route::post('signOut', 'App\Http\Controllers\MemberController@signOut'); //會員登出
    Route::post('member', 'App\Http\Controllers\MemberController@member'); //取得會員資料
    Route::post('getCart', 'App\Http\Controllers\CartController@getCart'); //取得購物車資料
    Route::post('editCart', 'App\Http\Controllers\CartController@editCart'); //編輯購物車商品資料
    Route::post('deleteCart', 'App\Http\Controllers\CartController@deleteCart'); //刪除購物車商品資料
    Route::post('checkOutCart', 'App\Http\Controllers\CartController@checkOutCart'); //結帳
    Route::post('getCheckedOutCart', 'App\Http\Controllers\CartController@getCheckedOutCart'); //取得已結帳訂單資料
});
