<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    /* attributes */
    protected $fillable=[
        'deliveried'
    ];

    /* Relationships */
    public function users()
    {
        return $this->belongsTo('users');
    }

    public function cart_items()
    {
        return $this->hasMany('cart_items');
    }
}
