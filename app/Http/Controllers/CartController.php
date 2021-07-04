<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Cart_items;

class CartController extends Controller
{
    /* 將商品放進購物車 */
    public function addProductsToCart(Request $request)
    {
        $member = $request->user(); // 新增會員購物車(或找出已存在卻沒結帳的購物車)
        $cart = Carts::createCart($member);

        $cart_item = Cart_items::createCartItem($cart, $request); // 將商品放進購物車
        return response($cart_item);
    }
}
