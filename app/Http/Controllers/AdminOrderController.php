<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminOrderController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $orders = Order::with('user')->orderByDesc('created_at')->simplePaginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $orderItems = $order->items;

        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    public function edit(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $statuses = ['Ожидает', 'В обработке', 'Доставляется', 'Доставлен'];

        return view('admin.orders.edit', compact('order', 'statuses'));
    }
}
