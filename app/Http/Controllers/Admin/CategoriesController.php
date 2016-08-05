<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Stock\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.categories.index')->with(compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show')->with(compact('category'));
    }

    public function store(Request $request)
    {
        $category = Category::create($request->only(['name', 'description']));

        $this->flasher->success('Category Added!', 'You have successfully created a new category. Top stuff, sir!');

        return redirect('admin/categories/' . $category->id);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->only(['name', 'description']));

        $this->flasher->success('Success!', 'The information has been updated.');

        return redirect('admin/categories/' . $category->id);
    }

    public function delete(Category $category)
    {
        $category->delete();

        $this->flasher->success('Deleted', 'The category has been deleted');

        return redirect('admin/categories');
    }
}
