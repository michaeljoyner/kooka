<?php

namespace App\Http\Controllers\Admin;

use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    public function show(Product $product)
    {
        return view('admin.products.show')->with(compact('product'));
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $category->addProduct($request->only(['name', 'description', 'price']));

        return redirect('admin');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => '',
            'price' => 'required|numeric'
        ]);

        $product->updateFromUserInput($request->only(['name', 'description', 'writeup',  'price']));

        return redirect('admin');
    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect('admin');
    }

    public function setAvailability(Request $request, Product $product)
    {
        $this->validate($request, ['available' => 'required|boolean']);

        $newState = $product->setAvailabilityTo($request->available);

        return response()->json(['new_state' => $newState]);
    }
}
