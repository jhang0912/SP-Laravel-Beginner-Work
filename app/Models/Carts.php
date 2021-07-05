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
            'checked_out' => 0
        ]);

        return $cart;
    }
}
