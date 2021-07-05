<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_items extends Model
{
    use HasFactory;

    /* attributes */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /* Relationships */
    public function carts()
    {
        return $this->belongsTo(Carts::class);
    }

    public function products()
    {
        return $this->hasOne(Products::class, 'id','product_id');
    }

    /* functions */
    static function createCartItem($cart, $product)
    {
        $cart_item = $cart->cart_items()->make([
            'product_id' => $product->id,
            'quantity' => $product->quantity
        ]);
        $cart_item->save();

        return $cart_item;
    }
}
