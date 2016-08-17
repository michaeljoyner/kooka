<?php

namespace App\Http\Controllers;

use App\Shopping\Cart;
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $topSellers = $this->getPromotedProducts();
        return view('front.pages.home')->with(compact('categories', 'topSellers'));
    }

    public function category($slug)
    {
        $category = Category::with('products')->where('slug', $slug)->first();

        return view('front.pages.category')->with(compact('category'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('front.pages.product')->with(compact('product'));
    }

    public function cart()
    {
        return view('front.pages.cart');
    }

    public function checkout(Cart $cart)
    {
        $orderedItems = $cart->items()->values();
        $cart_subtotal = $cart->totalPrice();
        return view('front.pages.checkout')->with(compact('orderedItems', 'cart_subtotal'));
    }

    private function getPromotedProducts()
    {
        $promoted = Product::where('available', 1)->where('promoted', 1)->limit(9)->get();

        if($promoted->count() < 9) {
            $remaining = 9 - $promoted->count();
            $filler = Product::where('available', 1)->where('promoted', 0)->orderByRaw('RAND()')->take($remaining)->get();
            $promoted = $promoted->merge($filler);
        }

        return $promoted;
    }
}
