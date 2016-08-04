<?php
use App\Orders\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/19/16
 * Time: 8:31 AM
 */
class OrdersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_order_can_be_archived_via_rest_endpoint()
    {
        $order = factory(Order::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('DELETE', '/admin/orders/' . $order->id);
        $this->assertEquals(200, $response->status());

        $order = Order::withTrashed()->find($order->id);
        $this->assertTrue($order->isArchived());
    }

    /**
     *@test
     */
    public function an_order_can_be_archived_by_posting_to_endpoint()
    {
        $order = factory(Order::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/orders/' . $order->id . '/archive', [
            'current' => false
        ]);
        $this->assertEquals(200, $response->status());

        $order = Order::withTrashed()->find($order->id);
        $this->assertTrue($order->isArchived(), 'order should be archived');
    }
}