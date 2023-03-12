<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->input('category');

        $categories = Category::all();

        $productsQuery = Product::query();

        if ($selectedCategory) {
            $productsQuery->inCategory($selectedCategory);
        }

        $products = Product::with('categories')->orderBy('created_at', 'desc')->paginate(9);

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
