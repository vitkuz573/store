<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminProductController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.products.create');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->cartItems()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно удален');
    }
}
