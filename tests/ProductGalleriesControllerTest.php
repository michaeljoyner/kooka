<?php
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/9/16
 * Time: 1:27 PM
 */
class ProductGalleriesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_may_be_uploaded_and_put_into_a_given_products_gallery()
    {
        $product = factory(Product::class)->create();
        $this->assertCount(0, $product->getGalleryMedia());
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/products/' . $product->id . '/gallery/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $product->getGalleryMedia());

        $product->clearGallery();
    }
}