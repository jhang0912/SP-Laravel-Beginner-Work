<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /* attributes */
    protected $fillable = [
        'cht_name',
        'en_name',
        'content',
        'price',
        'quantity',
    ];

    /* Relationships */
    public function cart_items()
    {
        return $this->hasMany(Cart_items::class);
    }

    /* function */
    static function checkProductQuantity($product)
    {
        $quantity = Products::find($product->id)->quantity; //取得商品庫存數量

        if ($product->quantity > $quantity) {//比對選購數量否超過庫存數量
            return false;
        } else {
            return true;
        }
    }
}
