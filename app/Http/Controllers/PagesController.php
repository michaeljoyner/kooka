<?php

namespace App\Http\Controllers;

use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('front.pages.home')->with(compact('categories'));
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
}
