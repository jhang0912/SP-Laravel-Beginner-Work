<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Cart_items;
use App\Models\Products;

class CartController extends Controller
{
    /* 將商品放進購物車 */
    public function addProductsToCart(Request $request) //→id、quantity
    {
        $member = $request->user();
        $cart = Carts::createCart($member);

        $check_quantity = Products::checkProductQuantity($request);
        if ($check_quantity == false) {
            return response('您選購的商品庫存不足，請重新選購，謝謝');
        }

        $cart_item = Cart_items::createCartItem($cart, $request);
        return response($cart_item);
    }

    /* 取得購物車資料 */
    public function getCart(Request $request)
    {
        $member = $request->user();
        $cart = $member->carts()->with('cart_items.products')->get();

        return response($cart);
    }

    /* 編輯購物車商品資料(修改數量) */
    public function editCart(Request $request) //→id、quantity
    {
        $member = $request->user();
        $cart = $member->carts()->where('checked_out', 0)->with('cart_items.products')->first();
        $cart_id = $cart->id;

        $check_quantity = Products::checkProductQuantity($request);
        if ($check_quantity == false) {
            return response('您選購的商品庫存不足，請重新選購，謝謝');
        } else {
            $edit_result = Cart_items::editCartItemQuantity($cart_id, $request);
        }

        if ($edit_result) {
            return response('商品數量編輯成功！！');
        } else {
            return response('商品數量編輯失敗！！');
        }
    }

    /* 刪除購物車商品資料 */
    public function deleteCart(Request $request) //→id
    {
        $member = $request->user();
        $cart = $member->carts()->where('checked_out', 0)->with('cart_items.products')->first();
        $cart_id = $cart->id;

        $delete_result = Cart_items::deleteCartItem($cart_id, $request);

        if ($delete_result) {
            return response('購物車商品刪除成功！！');
        } else {
            return response('購物車商品刪除失敗！！');
        }
    }

    /* 購物車結帳 */
    public function checkOutCart(Request $request)
    {
        $member = $request->user();
        $cart = $member->carts()->where('checked_out', 0)->with('cart_items.products')->first();
        if ($cart) {
            foreach ($cart->cart_items as $cart_item) {
                $product_quantity = $cart_item->products->quantity;
                $order_quantity = $cart_item->quantity;

                if ($order_quantity > $product_quantity) {
                    return response('商品「' . $cart_item->products->cht_name . '」庫存不足，請重新選購，謝謝');
                }
            }
        }else{
            return response('親愛的會員，您的購物車尚未建立');
        }

        $checkOut_result = Carts::checkOutCart($cart);

        return response('結帳成功！！您的訂單編號為「' . $cart->id . '」，可至會員中心查詢訂單處理進度，謝謝！！');
    }
}
