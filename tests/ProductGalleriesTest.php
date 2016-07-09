<?php
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/9/16
 * Time: 1:16 PM
 */
class ProductGalleriesTest extends Testcase
{
    use TestsImageUploads, DatabaseMigrations;

    /**
     *@test
     */
    public function an_image_can_be_added_to_a_products_gallery()
    {
        $product = factory(Product::class)->create();
        $image = $this->prepareFileUpload('tests/testpic1.png');

        $product->addGalleryImage($image);

        $this->assertCount(1, $product->getGalleryMedia());

        $product->clearGallery();
    }
}