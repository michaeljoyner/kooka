<?php
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/8/16
 * Time: 10:44 AM
 */
class ProductsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_product_can_be_stored_in_the_database()
    {
        $category = factory(Category::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/categories/' . $category->id . '/products', [
            'name' => 'Ultrathon 3000',
            'description' => 'The hammer of God',
            'price' => 0
        ]);
        $this->assertEquals(302, $response->status());

        $this->seeInDatabase('products', [
            'name' => 'Ultrathon 3000',
            'description' => 'The hammer of God',
            'price' => 0
        ]);
    }

    /**
     *@test
     */
    public function a_product_posted_is_expected_to_have_a_price_in_rands_but_is_stored_as_cents()
    {
        $category = factory(Category::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/categories/' . $category->id . '/products', [
            'name' => 'Ultrathon 3000',
            'description' => 'The hammer of God',
            'price' => '123.25'
        ]);
        $this->assertEquals(302, $response->status());

        $this->seeInDatabase('products', [
            'name' => 'Ultrathon 3000',
            'description' => 'The hammer of God',
            'price' => 12325
        ]);
    }

    /**
     *@test
     */
    public function a_products_info_can_be_edited()
    {
        $product = factory(Product::class)->create();
        $this->asLoggedInUser();

        $this->visit('/admin/products/' . $product->id . '/edit')
            ->type('A new name', 'name')
            ->type('A new description', 'description')
            ->type('A compelling argument', 'writeup')
            ->type('666.66', 'price')
            ->press('Save Changes')
            ->seeInDatabase('products', [
                'id' => $product->id,
                'name' => 'A new name',
                'description' => 'A new description',
                'writeup' => 'A compelling argument',
                'price' => 66666
            ]);
    }

    /**
     *@test
     */
    public function a_product_can_be_soft_deleted()
    {
        $this->asLoggedInUser();
        $product = factory(Product::class)->create();

        $response = $this->call('DELETE', '/admin/products/' . $product->id);
        $this->assertEquals(302, $response->status());

        $this->assertSoftDeleted($product);
    }

    /**
     *@test
     */
    public function a_products_availability_can_be_set()
    {
        $this->asLoggedInUser();
        $product = factory(Product::class)->create();

        $response = $this->call('POST', '/admin/products/' . $product->id . '/availability', [
            'available' => true
        ]);
        $this->assertEquals(200, $response->status());

        $product = Product::find($product->id);
        $this->assertTrue($product->available);
    }
}