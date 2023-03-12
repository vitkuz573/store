<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderByDesc('created_at')->simplePaginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $orderItems = $order->items;

        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    public function edit(Order $order)
    {
        $statuses = ['Ожидает', 'В обработке', 'Доставляется', 'Доставлен'];

        return view('admin.orders.edit', compact('order', 'statuses'));
    }
}
