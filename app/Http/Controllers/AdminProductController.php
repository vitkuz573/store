<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function edit(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::all();
        $selectedCategories = $product->categories->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'selectedCategories'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->cartItems()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно удален');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->stock = $request['stock'];
        $product->is_new = $request['is_new'] ?? false;
        $product->image_url = $request['image_url'];
        $product->categories()->sync($request['categories']);

        $product->save();

        return redirect()->route('admin.products.index');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->stock = $request['stock'];
        $product->is_new = (int) $request['is_new'];
        $product->image_url = $request['image_url'];

        $product->save();

        $product->categories()->sync($request['categories']);

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно добавлен');
    }
}
