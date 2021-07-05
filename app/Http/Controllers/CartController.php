<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Cart_items;
use App\Models\Products;

class CartController extends Controller
{
    /* 將商品放進購物車 */
    public function addProductsToCart(Request $request) //→商品id、quantity
    {
        $member = $request->user(); // 新增會員購物車(或找出已存在卻沒結帳的購物車)
        $cart = Carts::createCart($member);

        $check_quantity = Products::checkProductQuantity($request);
        if ($check_quantity == false) {
            return response('您選購的商品庫存不足，請重新選購，謝謝');
        }

        $cart_item = Cart_items::createCartItem($cart, $request); // 將商品放進購物車
        return response($cart_item);
    }

    /* 取得購物車資料 */
    public function getCart(Request $request)
    {
        $member = $request->user();
        $cart = $member->carts()->with('cart_items.products')->get();

        return response($cart);
    }

    /* 編輯購物車資料(修改數量) */
    public function editCart(Request $request) //→商品id、quantity
    {
        $member = $request->user();
        $cart = $member->carts()->with('cart_items.products')->first();
        $cart_id = $cart->id;

        $check_quantity = Products::checkProductQuantity($request);
        if ($check_quantity == false) {
            return response('您選購的商品庫存不足，請重新選購，謝謝');
        } else {
            $edit_result = Cart_items::editCartItemQuantity($cart_id, $request);
        }

        if($edit_result){
            return response('商品數量編輯成功！！');
        }else{
            return response('商品數量編輯失敗！！');
        }
    }
}
