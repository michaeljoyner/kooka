<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/18/16
 * Time: 11:17 AM
 */

namespace App\Orders;


use App\Shopping\Cart;
use App\Stock\Product;

class OrderFactory
{
    public static function makeFromRequestAndCart($request, Cart $cart)
    {
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'enquiry' => $request->enquiry,
            'original_quote' => $cart->totalPrice()
        ]);
        $cart->items()->map(function($item) {
            return [
                'product' => Product::findOrFail($item->id),
                'quantity' => $item->qty
            ];
        })->each(function($product) use ($order) {
            $order->addItem($product['product'], $product['quantity']);
        });

        return $order;
    }
}