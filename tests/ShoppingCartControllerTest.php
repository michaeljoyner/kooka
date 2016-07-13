<?php
use App\Shopping\Cart;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/12/16
 * Time: 9:41 AM
 */
class ShoppingCartControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_product_can_be_added_to_the_cart()
    {
        $product = factory(Product::class)->create();
        $cart = new Cart();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/cart/add', [
            'id' => $product->id,
            'quantity' => 5
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $cart->items());
        $this->assertEquals(5, $cart->countItems());
    }

    /**
     *@test
     */
    public function a_product_that_exists_in_the_cart_can_have_its_qty_updated()
    {
        $product = factory(Product::class)->create();
        $cart = new Cart();
        $cart->add($product, 1);
        $this->assertEquals(1, $cart->countItems());
        $this->assertEquals(1, $cart->countProducts());

        $this->withoutMiddleware();
        $response = $this->call('PATCH', '/cart/update', [
            'id' => $product->id,
            'quantity' => 5
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertEquals(5, $cart->countItems());
        $this->assertEquals(1, $cart->countProducts());
    }

    /**
     *@test
     */
    public function a_product_can_be_removed_from_the_cart()
    {
        $product = factory(Product::class)->create();
        $cart = new Cart();
        $cart->add($product, 1);
        $this->assertEquals(1, $cart->countItems());
        $this->assertEquals(1, $cart->countProducts());

        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/cart/remove', [
            'id' => $product->id,
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(0, $cart->items());
    }

    /**
     *@test
     */
    public function the_current_state_of_the_cart_can_be_fetched()
    {
        $product = factory(Product::class)->create(['price' => 1000]);
        $product2 = factory(Product::class)->create(['price' => 2000]);

        $cart = new Cart();
        $cart->add($product, 3);
        $cart->add($product2, 1);

        $expected = [
            'item_count' => 4,
            'product_count' => 2,
            'price' => '50.00'
        ];

        $response = $this->call('GET', '/cart/summary');
        $this->assertEquals(200, $response->status());

        $this->assertEquals($expected, json_decode($response->getContent(), true));
    }

    /**
     *@test
     */
    public function an_index_of_the_cart_contents_can_be_retrieved()
    {
        $product = factory(Product::class)->create(['name' => 'Ultrathon 3000', 'price' => 1000]);
        $product2 = factory(Product::class)->create(['name' => 'SledgeHammer XL', 'price' => 2000]);

        $cart = new Cart();
        $cart->add($product, 3);
        $cart->add($product2, 1);

        $expected = [
            [
                'id' => $product->id,
                'name' => 'Ultrathon 3000',
                'quantity' => 3,
                'price' => 10.00,
                'subtotal' => 30.00
            ],
            [
                'id' => $product2->id,
                'name' => 'SledgeHammer XL',
                'quantity' => 1,
                'price' => 20.00,
                'subtotal' => 20.00
            ]
        ];

        $response = $this->call('GET', '/cart/index');
        $this->assertEquals(200, $response->status());

        $this->assertEquals($expected, json_decode($response->getContent(), true));
    }
}