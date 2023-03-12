<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'category' => 'nullable|string|regex:/^[a-zA-Z0-9_-]+$/',
        ]);

        $category = strtolower($request->input('category'));

        $categories = Category::has('products')->get();

        $productsQuery = Product::query();

        if ($category) {
            $productsQuery->whereHas('categories', function ($query) use ($category) {
                $query->whereName($category);
            });
        }

        $products = $productsQuery->with('categories')->orderBy('created_at', 'desc')->paginate(9);

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
