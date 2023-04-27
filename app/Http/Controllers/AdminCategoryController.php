<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', __('Категория успешно создана.'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', __('Категория успешно обновлена.'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', __('Категория успешно удалена'));
    }
}
