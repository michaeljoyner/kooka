<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/12/16
 * Time: 9:04 AM
 */

namespace App\Shopping;


use App\Stock\Price;
use App\Stock\Product;
use Gloudemans\Shoppingcart\Facades\Cart as ShoppingCart;

class Cart
{
    public function add(Product $product, $quantity)
    {
        return ShoppingCart::add($product->id, $product->name, $quantity, $product->price->asRandCentsFloat());
    }

    public function update($productId, $quantity)
    {
        ShoppingCart::update($this->getRowIDfromProductId($productId), $quantity);
    }

    public function remove($productId)
    {
        ShoppingCart::remove($this->getRowIDfromProductId($productId));
    }

    protected function getRowIDfromProductId($productId)
    {
        $rowId = collect(ShoppingCart::search(['id' => $productId]))->first();
        if(! $rowId) {
            throw new \InvalidArgumentException('Product [id = ' . $productId . ' ] is not in the cart');
        }
        return $rowId;
    }

    public function items()
    {
        return ShoppingCart::content();
    }

    public function countItems()
    {
        return ShoppingCart::count();
    }

    public function countProducts()
    {
        return ShoppingCart::count(false);
    }

    public function totalPrice()
    {
        return Price::fromCents(intval(ShoppingCart::total() * 100))->asCurrencyString();
    }


}