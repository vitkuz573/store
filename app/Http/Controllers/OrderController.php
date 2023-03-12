<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderByDesc('created_at')->simplePaginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $orderItems = $order->items;

        return view('orders.show', compact('order', 'orderItems'));
    }
}
