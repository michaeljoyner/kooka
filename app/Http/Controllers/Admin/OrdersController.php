<?php

namespace App\Http\Controllers\Admin;

use App\Orders\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index')->with(compact('orders'));
    }

    public function archivesIndex()
    {
        $orders = Order::onlyTrashed()->latest()->paginate(10);
        return view('admin.orders.archived')->with(compact('orders'));
    }

    public function show($order)
    {
        $order = Order::withTrashed()->findOrFail($order);
        return view('admin.orders.show')->with(compact('order'));
    }

    public function delete(Order $order)
    {
        $order->archive();

        return response()->json('ok');
    }

    public function current(Request $request, $order)
    {
        $this->validate($request, ['current' => 'required|boolean']);

        $order = Order::withTrashed()->findOrFail($order);

        (! $request->current) ? $order->archive() : $order->revive();

        return response()->json(['new_state' => ! $order->isArchived()]); //true represents current
    }
}
