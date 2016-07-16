<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

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

        $product = $category->addProduct($request->only(['name', 'description', 'price']));

        $this->flasher->success('Product added!', $product->name . ' was successfully added to ' . $category->name);

        return redirect('admin/products/' . $product->id);
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

        $this->flasher->success('Success', $product->name . ' was successfully updated');

        return redirect('admin/products/' . $product->id);
    }

    public function delete(Product $product)
    {
        $categoryId = $product->category->id;

        $product->delete();

        $this->flasher->success('Success', 'The product has been successfully deleted.');

        return redirect('admin/categories/' . $categoryId);
    }

    public function setAvailability(Request $request, Product $product)
    {
        $this->validate($request, ['available' => 'required|boolean']);

        $newState = $product->setAvailabilityTo($request->available);

        return response()->json(['new_state' => $newState]);
    }
}
