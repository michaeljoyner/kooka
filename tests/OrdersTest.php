<?php
use App\Orders\Order;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/18/16
 * Time: 10:41 AM
 */
class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_order_can_be_created()
    {
        $this->assertInstanceOf(Order::class, factory(Order::class)->create());
    }

    /**
     *@test
     */
    public function an_item_can_be_added_to_an_order()
    {
        $product = factory(Product::class)->create();
        $order = factory(Order::class)->create();
        $this->assertCount(0, $order->items);

        $order->addItem($product, 1);

        $order = Order::find($order->id);
        $this->assertCount(1, $order->items);

        $this->assertEquals($product->name, $order->items->first()->name);
    }

    /**
     *@test
     */
    public function orders_can_be_archived_which_is_the_same_as_soft_deleted()
    {
        $order = factory(Order::class)->create();

        $order->archive();
        $this->assertTrue($order->isArchived());
        $this->assertSoftDeleted($order);
    }

    /**
     *@test
     */
    public function an_archived_order_can_be_revived()
    {
        $order = factory(Order::class)->create();

        $order->archive();
        $this->assertTrue($order->isArchived());

        $order->revive();
        $this->assertFalse($order->isArchived());
    }
}