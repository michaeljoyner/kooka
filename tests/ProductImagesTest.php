<?php
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/9/16
 * Time: 10:12 AM
 */
class ProductImagesTest extends TestCase
{
    use TestsImageUploads, DatabaseMigrations;

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_associated_with_a_product()
    {
        $product = factory(Product::class)->create();
        $this->assertCount(0, $product->getMedia());
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/products/' . $product->id . '/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertCount(1, $product->getMedia());

        $product->clearMediaCollection();
    }
}