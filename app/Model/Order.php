<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "order_code", 'product_id', "product_name", "price", "pelanggan_id", "qty"

    ];
}
