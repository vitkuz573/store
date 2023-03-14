<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        return view('orders.show', compact('order', 'orderItems'));
    }

    public function edit(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $statuses = ['Ожидает', 'В обработке', 'Доставляется', 'Доставлен'];

        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validatedData = $request->validate([
            'status' => ['required', 'in:Ожидает,В обработке,Доставляется,Доставлен'],
        ]);

        $order->status = $validatedData['status'];
        $order->save();

        return redirect()->route('admin.orders.index');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', __('Заказ успешно удален.'));
    }
}
