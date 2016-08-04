<?php

namespace App\Http\Controllers;

use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductImagesController extends Controller
{
    public function index(Product $product)
    {
        $images = $product->getGalleryMedia()->map(function($image) {
            return [
                'thumb_src' => $image->getUrl('thumb'),
                'web_src' => $image->getUrl('web')
            ];
        })->prepend([
            'thumb_src' => $product->imageSrc('thumb'),
            'web_src' => $product->imageSrc('web')
        ]);

        return response()->json($images);
    }
}
