<?php

namespace App\Http\Controllers;

use App\Shopping\Cart;
use App\Stock\Price;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class ShoppingCartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return $this->cart->items()->map(function($item) {
            $product = Product::findOrFail($item->id);
            return [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $item->qty,
                'price' => $product->price,
                'subtotal' => Price::fromCents($product->price->inCents() * $item->qty)->asCurrencyString(),
                'thumb' => $product->imageSrc('thumb')
            ];
        })->values();
    }

    public function summary()
    {
        return response()->json([
            'item_count' => $this->cart->countItems(),
            'product_count' => $this->cart->countProducts(),
            'price' => $this->cart->totalPrice()
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|between:0,100'
        ]);

        $this->cart->add(Product::findOrFail($request->get('id')), $request->quantity);

        return response()->json('ok');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|between:0,100'
        ]);

        $item = $this->cart->update($request->get('id'), $request->quantity);

        return response()->json([
            'id' => $item->id,
            'quantity' => $item->qty,
            'subtotal' => $item->subtotal
        ]);

    }

    public function remove(Request $request)
    {
        $this->validate($request, ['id' => 'required|exists:products,id']);

        $this->cart->remove($request->get('id'));

        return response()->json('ok');
    }


}
