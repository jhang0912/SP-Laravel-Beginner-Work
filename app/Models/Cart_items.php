<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_items extends Model
{
    use HasFactory;

    /* attributes */
    protected $fillable=[
        'cart_id',
        'product_id'
    ];

    /* Relationships */
    public function carts()
    {
        return $this->belongsTo('carts');
    }

    public function products()
    {
        return $this->belongsTo('products');
    }
}
