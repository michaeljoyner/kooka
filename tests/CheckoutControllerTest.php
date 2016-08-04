<?php
use App\Shopping\Cart;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/18/16
 * Time: 11:39 AM
 */
class CheckoutControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_checkout_form_gets_processed_properly()
    {
        $product1 = factory(Product::class)->create(['name' => 'product one', 'price' => 1000]);
        $product2 = factory(Product::class)->create(['name' => 'product two', 'price' => 2000]);

        $cart = new Cart();
        $cart->add($product1, 1);
        $cart->add($product2, 2);

        $this->visit('/checkout')
            ->type('Joe Soap', 'customer_name')
            ->type('0123456789', 'customer_phone')
            ->type('joe@example.com', 'customer_email')
            ->type('123 Sesame street', 'customer_address')
            ->type('I would just like to say...', 'enquiry')
            ->press('Get Quote')
            ->seeInDatabase('orders', [
                'customer_name' => 'Joe Soap',
                'customer_phone' => '0123456789',
                'customer_email' => 'joe@example.com',
                'customer_address' => '123 Sesame street',
                'enquiry' => 'I would just like to say...',
                'original_quote' => "50.00"
            ])
            ->seeInDatabase('order_items', [
                'name' => 'product one',
                'quantity' => 1,
                'price' => 1000,
                'quote' => '10.00'
            ])
            ->seeInDatabase('order_items', [
                'name' => 'product two',
                'quantity' => 2,
                'price' => 2000,
                'quote' => '40.00'
            ]);
    }
}