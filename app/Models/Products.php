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
        return $this->hasMany('cart_items');
    }
}
