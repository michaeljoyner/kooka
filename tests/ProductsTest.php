<?php
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/9/16
 * Time: 10:46 AM
 */
class ProductsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_products_price_is_an_instance_of_price()
    {
        $product = factory(Product::class)->create(['price' => 3333]);

        $this->assertInstanceOf(\App\Stock\Price::class, $product->price);
    }

    /**
     *@test
     */
    public function a_products_availability_can_be_set()
    {
        $product = factory(Product::class)->create();
        $this->assertFalse($product->available, 'product should initially be unavailable');

        $product->setAvailabilityTo(true);
        $this->assertTrue($product->available);
    }

    /**
     *@test
     */
    public function a_product_can_be_promoted_or_not()
    {
        $product = factory(Product::class)->create();

        $product->promote();
        $this->assertTrue($product->isPromoted());

        $product->demote();
        $this->assertFalse($product->isPromoted());
    }
}