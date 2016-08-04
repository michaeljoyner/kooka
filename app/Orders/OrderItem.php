<?php

namespace App\Orders;

use App\Stock\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'quantity',
        'quote'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
