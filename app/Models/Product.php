<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'prod_id';

    public function orderProduct(){
        return $this->hasMany(Order_Product::class);
    }
}
