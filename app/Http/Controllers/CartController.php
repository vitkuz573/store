<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
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

    public function add(Request $request, Product $product): RedirectResponse
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

        return redirect()->route('products.index')->with('success', 'Товар успешно добавлен в корзину!');
    }

    public function remove($productId): JsonResponse
    {
        $user = Auth::user();
        $cart = Cart::whereUserId($user->id)->first();

        if (!$cart) {
            return response()->json(['error' => 'Корзина пуста!']);
        }

        $cart->removeProduct($productId);

        Cache::forget('user-cart-' . $user->id);

        $totalPrice = $cart->getTotalPrice();

        return response()->json([
            'totalPrice' => $totalPrice
        ]);
    }

    public function update(Request $request, $productId): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'quantity' => 'required|numeric|min:1'
            ]);

            $user = Auth::user();
            $cart = Cart::whereUserId($user->id)->first();

            if (!$cart) {
                return response()->json(['error' => 'Корзина пуста!']);
            }

            $product = Product::find($productId);

            if (!$product) {
                return response()->json(['error' => 'Товар не найден!']);
            }

            $cart->updateProductQuantity($product, $validatedData['quantity']);

            Cache::forget('user-cart-' . $user->id);

            $updatedCartItem = $cart->items()->whereProductId($productId)->first();

            if (!$updatedCartItem) {
                return response()->json(['error' => 'Элемент не найден!']);
            }

            return response()->json([
                'quantity' => $updatedCartItem->quantity,
                'totalPrice' => $cart->getTotalPrice()
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function clear(): RedirectResponse
    {
        $user = Auth::user();
        $cart = Cart::whereUserId($user->id)->first();

        $cart?->items()->delete();

        Cache::forget('user-cart-' . $user->id);

        return redirect()->route('cart.index')->with('success', 'Корзина успешно очищена!');
    }
}
