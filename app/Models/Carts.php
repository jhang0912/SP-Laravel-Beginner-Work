<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    /* attributes */
    protected $fillable = [
        'user_id',
        'total_price',
        'checked_out',
        'deliveried'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /* Relationships */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_items()
    {
        return $this->hasMany(Cart_items::class, 'cart_id');
    }

    /* functions */
    static function createCart($member)
    {
        $cart = Carts::firstOrCreate([
            'user_id' => $member['id'],
            'total_price' => 0,
            'checked_out' => 0
        ]);

        return $cart;
    }

    static function checkOutCart($cart)
    {
        $discount = [1, 0.95, 0.85];
        $total_price = 0;

        foreach ($cart->cart_items as $cart_item) { //計算總金額
            $product_price = $cart_item->products->price;
            $product_quantity = $cart_item->products->quantity;
            $order_quantity = $cart_item->quantity;
            $total_price += $product_price * $order_quantity;

            Products::find($cart_item->products->id)
                ->update([
                    'quantity' => $product_quantity - $order_quantity
                ]);
        }

        $member = User::find($cart->user_id);
        $total_price = ceil($total_price * $discount[$member->level]);


        $cart->update([
            'checked_out' => 1,
            'total_price' => $total_price
        ]);


        return $total_price;
    }
}
