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

        $products = $this->applyFilters(Product::query(), compact('selectedCategories', 'minPrice', 'maxPrice', 'search'))
            ->with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('products.index', compact('products', 'categories', 'selectedCategories', 'minPrice', 'maxPrice'));
    }

    private function applyFilters($query, array $filters)
    {
        return $query->when(!empty($filters['selectedCategories']), fn($query) =>
            $query->whereHas('categories', fn($q) =>
                $q->whereIn('categories.id', $filters['selectedCategories'])
            )
        )
        ->when($filters['minPrice'], fn($query) => $query->where('price', '>=', $filters['minPrice']))
        ->when($filters['maxPrice'], fn($query) => $query->where('price', '<=', $filters['maxPrice']))
        ->when($filters['search'], fn($query) => $query->where('name', 'LIKE', '%' . $filters['search'] . '%'));
    }

    public function show(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('products.show', compact('product'));
    }
}
