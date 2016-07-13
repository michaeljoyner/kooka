<?php

namespace App\Http\Controllers;

use App\Shopping\Cart;
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
            return [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal
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

        $this->cart->update($request->get('id'), $request->quantity);

        return response()->json('ok');
    }

    public function remove(Request $request)
    {
        $this->validate($request, ['id' => 'required|exists:products,id']);

        $this->cart->remove($request->get('id'));

        return response()->json('ok');
    }


}
