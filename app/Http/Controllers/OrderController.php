<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $orders = Order::with('user')->orderByDesc('created_at')->simplePaginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $orderItems = $order->items;

        return view('orders.show', compact('order', 'orderItems'));
    }
}
