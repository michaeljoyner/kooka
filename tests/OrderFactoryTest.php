<?php
use App\Orders\OrderFactory;
use App\Shopping\Cart;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/18/16
 * Time: 11:00 AM
 */
class OrderFactoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_make_an_order_from_a_order_form_request_and_cart_instance()
    {
        $product1 = factory(Product::class)->create(['name' => 'product one', 'price' => 1000]);
        $product2 = factory(Product::class)->create(['name' => 'product two', 'price' => 2000]);

        $cart = new Cart();
        $cart->add($product1, 1);
        $cart->add($product2, 2);

        $mockRequest = (object)[
            'customer_name'    => 'Joe Soap',
            'customer_phone'   => '0123456789',
            'customer_email'   => 'joe@example.com',
            'customer_address' => '123 Sesame street',
            'enquiry'          => 'How do I...?'
        ];

        $order = OrderFactory::makeFromRequestAndCart($mockRequest, $cart);

        $this->assertEquals('Joe Soap', $order->customer_name);
        $this->assertEquals('0123456789', $order->customer_phone);
        $this->assertEquals('joe@example.com', $order->customer_email);
        $this->assertEquals('123 Sesame street', $order->customer_address);
        $this->assertEquals('How do I...?', $order->enquiry);
        $this->assertEquals('50.00', $order->original_quote);

        $this->assertCount(2, $order->items);
        $this->assertEquals('product one', $order->items->first()->name);
        $this->assertEquals('product two', $order->items->last()->name);
    }
}