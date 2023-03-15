<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View|Application|Factory
    {
        $selectedCategories = $request->input('categories', []);
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $search = $request->input('search');

        $categories = Category::has('products')->get();

        $productsQuery = Product::query();

        if (!empty($selectedCategories)) {
            $productsQuery->whereHas('categories', function ($query) use ($selectedCategories) {
                $query->whereIn('categories.id', $selectedCategories);
            });
        }

        if ($minPrice) {
            $productsQuery->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        if ($search) {
            $productsQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $products = $productsQuery->with('categories')->orderBy('created_at', 'desc')->paginate(8);

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function show(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('products.show', compact('product'));
    }
}
