<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function destroy(Product $product)
    {
        $product->cartItems()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно удален');
    }
}
