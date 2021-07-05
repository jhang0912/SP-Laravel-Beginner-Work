<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Cart_items;
use App\Models\Products;

class CartController extends Controller
{
    /* 將商品放進購物車 */
    public function addProductsToCart(Request $request) //商品id、quantity
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
}
