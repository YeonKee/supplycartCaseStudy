<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderProduct()
    {
        return $this->hasMany(Order_Product::class, 'order_id');
    }

    /**
     * Calculate the total price of all products
     * @return float 
     */
    public function calcTotal()
    {
        $orderProducts = $this->orderProduct;
        $total = 0;

        foreach ($orderProducts as $orderProd) {
            $total += $orderProd->calcProduct();
        }

        return $total;
    }

    /**
     * Return order_product if exist in cart
     * @param $prod_id the id of product to find in cart
     * @return Order_Product 
     */
    public function getCartItem($prod_id)
    {
        return $this->orderProduct->where('prod_id', $prod_id)->first();
    }
}
