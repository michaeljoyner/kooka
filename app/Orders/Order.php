<?php

namespace App\Orders;

use App\Stock\Price;
use App\Stock\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'enquiry',
        'original_quote'
    ];

    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function addItem(Product $product, $quantity)
    {
        return $this->items()->create([
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price->inCents(),
            'quantity' => $quantity,
            'quote' => Price::fromCents($product->price->inCents() * $quantity)->asCurrencyString()
        ]);
    }

    public function archive()
    {
        return $this->delete();
    }

    public function isArchived()
    {
        return $this->trashed();
    }

    public function revive()
    {
        return $this->restore();
    }
}
