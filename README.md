<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About「Laravel Beginner Work」

這是一份使用 PHP 框架 Laravel 進行撰寫的作品，以電商平台的各種功能為目標去實作，由於未撰寫前端元件 View，所以需搭配 Postman 進行測試，使用的技術元件與專案架構如下:

## Demo
### [Laravel Beginner Work Demo](https://www.youtube.com/watch?v=zQ1_1twdLvE&ab_channel=fueqaxvk)

## Routes
- POST：(cart：CartController@addProductsToCart)
- POST：(register：MemberController@register)
- group：([middleware => auth:api], function () {
    - POST：(cart：CartController@addProductsToCart)
    - POST：(signOut：MemberController@signOut)
    - POST：(member：MemberController@member)
    - POST：(getCart：CartController@getCart)
    - POST：(editCart：CartController@editCart)
    - POST：(deleteCart：CartController@deleteCart)
    - POST：(checkOutCart：CartController@checkOutCart)
    - POST：(getCheckedOutCart：CartController@getCheckedOutCart)
})

## Controllers
### Member
- 會員註冊　-register-
- 會員登入　-signIn-
- 取得會員資料　-member-
- 會員登出　-signOut-
### Cart
- 新增購物車與添加商品整合並搭配商品數量檢查防呆　-addProductsToCart-
- 取得購物車資料　-getCart-
- 編輯購物車商品資料(修改數量)　-editCart-
- 刪除購物車商品資料　-deleteCart-
- 購物車結帳並搭配會員VIP折扣優惠 -checkOutCart-
- 取得已結帳訂單資料 -getCheckedOutCart-

## Models
### User
- （id／name／email／email_verified_atpassword／level／remember_token／remember_tokencreated_at／updated_at）
### Carts
- （id／user_id／total_price／checked_out／deliveried／created_at／updated_at）
### Cart_items （use SoftDeletes）
- （id／cart_id／product_id／quantity／created_at／updated_at）
### Products
- （id／cht_name／en_name／content／price／quantity／created_at／updated_at）
