<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use App\Orders\OrderFactory;
use App\Shopping\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;

class CheckoutController extends Controller
{
    public function doCheckout(OrderFormRequest $request, Cart $cart)
    {
        $order = OrderFactory::makeFromRequestAndCart($request, $cart);

        if($order) {
            $cart->emptyContents();
        }

        return redirect('/');
    }
}
