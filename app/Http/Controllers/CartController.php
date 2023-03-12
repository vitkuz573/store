<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cache::remember('user-cart-' . $user->id, 3600, function () use ($user) {
            return Cart::with(['items' => function($query) {
                $query->with('product');
            }])->withCount('items')->where('user_id', $user->id)->first();
        });

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        $cartItems = $cart->items;
        $totalPrice = $cart->getTotalPrice();

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();
        $cart = Cart::whereUserId($user->id)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        if ($cart->hasProduct($product)) {
            $cart->incrementQuantity($product, $validatedData['quantity']);
        } else {
            $cart->addProduct($product, $validatedData['quantity']);
        }

        Cache::forget('user-cart-' . $user->id);

        return redirect()->route('products.index')->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request, Product $product)
    {
        $user = Auth::user();
        $cart = Cart::whereUserId($user->id)->first();

        if (!$cart) {
            return redirect()->route('products.index')->with('error', 'Cart is empty!');
        }

        $cart->removeProduct($product);

        Cache::forget('user-cart-' . $user->id);

        return redirect()->route('carts.show')->with('success', 'Product removed from cart successfully!');
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();
        $cart = Cart::whereUserId($user->id)->first();

        if (!$cart) {
            return redirect()->route('products.index')->with('error', 'Cart is empty!');
        }

        $cart->updateProductQuantity($product, $validatedData['quantity']);

        Cache::forget('user-cart-' . $user->id);

        return redirect()->route('carts.show')->with('success', 'Cart updated successfully!');
    }

    public function clear()
    {
        $user = Auth::user();
        $cart = Cart::whereUserId($user->id)->first();

        if ($cart) {
            $cart->items()->delete();
        }

        Cache::forget('user-cart-' . $user->id);

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    public function checkout()
    {
        // получить пользователя и корзину
        $user = Auth::user();
        $cart = Cache::remember('user-cart-' . $user->id, 3600, function () use ($user) {
            return Cart::with(['items' => function($query) {
                $query->with('product');
            }])->withCount('items')->where('user_id', $user->id)->first();
        });

        // если корзина пустая, перенаправить на страницу корзины
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        // получить список товаров в корзине и общую стоимость
        $cartItems = $cart->items;
        $totalPrice = $cart->getTotalPrice();

        // передать список товаров и общую стоимость в представление checkout.blade.php
        return view('cart.checkout', compact('cartItems', 'totalPrice'));
    }

    public function placeOrder(Request $request)
    {
        // получить пользователя и корзину
        $user = Auth::user();
        $cart = Cache::remember('user-cart-' . $user->id, 3600, function () use ($user) {
            return Cart::with(['items' => function($query) {
                $query->with('product');
            }])->withCount('items')->where('user_id', $user->id)->first();
        });

        // создать новый заказ
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $cart->getTotalPrice();
        $order->save();

        // добавить товары в заказ
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
        }

        // очистить корзину пользователя
        $cart->items()->delete();
        Cache::forget('user-cart-' . $user->id);

        // перенаправить на страницу заказов
        return redirect()->route('orders.index')->with('success', 'Your order has been placed successfully!');
    }
}
