<?php

namespace App\Http\Controllers\Admin;

use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Media;

class ProductGalleriesController extends Controller
{
    public function showGalleryPage(Product $product)
    {
        return view('admin.products.gallery')->with(compact('product'));
    }

    public function index(Product $product)
    {
        $images = $product->getGalleryMedia()->map(function($image) {
            return [
                'image_id' => $image->id,
                'src' => $image->getUrl(),
                'thumb_src' => $image->getUrl('thumb')
            ];
        })->toArray();

        return response()->json($images);

    }

    public function store(Request $request, Product $product)
    {
        $this->validate($request, ['file' => 'required|image']);

        $image =  $product->addGalleryImage($request->file('file'));

        return response()->json([
            'image_id' => $image->id,
            'src' => $image->getUrl(),
            'thumb_src' => $image->getUrl('thumb')
        ]);
    }

    public function deleteImage(Media $media)
    {
        $deleted = $media->delete();

        return response()->json(['deleted' => $deleted]);
    }
}
