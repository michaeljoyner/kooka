<?php
use App\Shopping\Cart;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/12/16
 * Time: 8:59 AM
 */
class ShoppingCartTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_product_can_be_added_to_the_shopping_cart()
    {
        $product = factory(Product::class)->create();
        $cart = new Cart();

        $cart->add($product, 1);

        $this->assertCount(1, $cart->items());
    }

    /**
     * @test
     */
    public function the_quantity_of_an_item_may_be_updated()
    {
        $cart = new Cart();
        $product = factory(Product::class)->create();

        $cart->add($product, 1);
        $this->assertCount(1, $cart->items());

        $cart->update($product->id, 3);
        $this->assertEquals(3, $cart->countItems());
        $this->assertEquals(1, $cart->countProducts());
    }

    /**
     *@test
     */
    public function a_item_may_be_removed_from_the_shopping_cart_using_the_product_id()
    {
        $cart = new Cart();
        $product = factory(Product::class)->create();

        $cart->add($product, 1);
        $this->assertCount(1, $cart->items());

        $cart->remove($product->id);
        $this->assertCount(0, $cart->items());
        $this->assertEquals(0, $cart->countItems());
    }

    /**
     *@test
     */
    public function the_total_price_of_the_cart_can_be_retrieved()
    {
        $cart = new Cart();
        $product = factory(Product::class)->create(['price' => 1000]);
        $product2 = factory(Product::class)->create(['price' => 2000]);

        $cart->add($product, 3);
        $cart->add($product2, 1);

        $this->assertEquals('50.00', $cart->totalPrice());
    }

    /**
     *@test
     */
    public function the_cart_can_be_emptied()
    {
        $cart = new Cart();
        $cart->add(factory(Product::class)->create(['price' => 1000]), 1);
        $cart->add(factory(Product::class)->create(['price' => 2000]), 2);

        $this->assertCount(2, $cart->items());

        $cart->emptyContents();
        $this->assertCount(0, $cart->items());
    }
}