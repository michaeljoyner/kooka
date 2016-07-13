<?php

namespace App\Http\Controllers\Admin;

use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsSearchController extends Controller
{

    public function showApp()
    {
        return view('admin.products.search.app');
    }

    public function index()
    {
        return Product::all()->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'thumb_src' => $product->imageSrc('thumb')
            ];
        })->values();
    }
}
