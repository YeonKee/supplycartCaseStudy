<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    public function order()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // Get user current cart (Update order)
    public function getCart()
    {
        return $this->order->where('status', 'Cart')->first();
    }

    // Create new cart for user if non-found
    public function createCart()
    {
        $newCart = new Order();
        $newCart->user_id = $this->user_id;
        $newCart->status = 'Cart';
        $newCart->save();

        return $newCart;
    }

    // Create member rank
    public function getRank($point)
    {
        if ($point >= 10000) {
            return 'Platinum';
        } else if ($point >= 7000) {
            return 'Gold';
        } else if ($point >= 4000) {
            return 'Silver';
        } else {
            return 'Classic';
        }
    }

    public function getDisocunt($rank)
    {
        switch ($rank) {
            case "Platinum":
                return 0.9;
            case "Gold":
                return 0.95;
            case "Silver":
                return 0.97;
            default:
                return 1.0;
        }
    }
}
