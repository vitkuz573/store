<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

    public function create(): Factory|View|\Illuminate\Foundation\Application|RedirectResponse|Application
    {
        $user = Auth::user();

        $cart = Cache::remember('user-cart-' . $user->id, 3600, function () use ($user) {
            return Cart::with(['items' => function($query) {
                $query->with('product');
            }])->withCount('items')->where('user_id', $user->id)->first();
        });

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста!');
        }

        $cartItems = $cart->items;
        $totalPrice = $cart->getTotalPrice();

        return view('orders.create', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $cart = Cache::remember('user-cart-' . $user->id, 3600, function () use ($user) {
            return Cart::with(['items' => function ($query) {
                $query->with('product');
            }])->withCount('items')->where('user_id', $user->id)->first();
        });

        if (!$cart || $cart->items_count === 0) {
            return redirect()->route('cart.index')->with('error', __('Корзина пуста!'));
        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $cart->getTotalPrice();
        $order->customer_name = $request->input('customer_name');
        $order->customer_email = $request->input('customer_email');
        $order->shipping_address = $request->input('shipping_address');
        $order->payment_method = $request->input('payment_method');
        $order->status = 'Ожидает';

        $order->save();

        foreach ($cart->items as $cartItem) {
            $product = $cartItem->product;
            $quantity = $cartItem->quantity;
            $price = $product->price;

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->quantity = $quantity;
            $orderItem->price = $price;
            $orderItem->save();

            $product->decrement('stock', $quantity);
        }

        $cart->items()->delete();
        Cache::forget('user-cart-' . $user->id);

        return redirect()->route('orders.index')->with('success', __('Ваш заказ успешно размещен!'));
    }
}
