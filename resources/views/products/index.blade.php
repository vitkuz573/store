@extends('layouts.app')

@section('content')
    <div class="row mx-5">
        <div class="col-md-3 mb-4">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="form-group mt-3">
                    <label for="min_price">Минимальная цена:</label>
                    <input type="number" name="min_price" id="min_price" class="form-control" value="{{ $minPrice }}" min="0" step="1">
                </div>
                <div class="form-group mt-3">
                    <label for="max_price">Максимальная цена:</label>
                    <input type="number" name="max_price" id="max_price" class="form-control" value="{{ $maxPrice }}" min="0" step="1">
                </div>

                <div class="form-group mt-3">
                    <label for="category">Категория:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}" {{ $selectedCategory === $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Показать</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3 ms-2">Сбросить</a>
            </form>
        </div>
        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @forelse($products as $product)
                    <div class="col mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <a href="{{ route('products.show', $product) }}" class="stretched-link"></a>
                            <div class="position-relative">
                                @if($product->is_new)
                                    <div class="card-badge bg-primary text-white fw-bold rounded-pill px-2 py-1 position-absolute top-0 start-0 my-2 mx-3">
                                        New!
                                    </div>
                                @endif
                                <img src="{{ $product->image_url }}" class="card-img-top rounded-3" alt="{{ $product->name }} image">
                            </div>
                            <div class="card-body p-3">
                                <h5 class="card-title fw-bold mb-2">{{ $product->name }}</h5>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="card-text text-primary fw-bold h5 mb-0">{{ $product->price }} руб.</p>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Подробнее</a>
                                </div>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 150) }}</p>
                                @if($product->stock <= 0)
                                    <p class="text-danger mt-2">Нет в наличии</p>
                                @else
                                    <p class="text-success mt-2">В наличии</p>
                                @endif
                                @if($product->categories->count() > 0)
                                    <p class="card-text text-muted mt-2">
                                        @foreach($product->categories->pluck('name') as $category)
                                            <span class="badge bg-primary ms-2">{{ $category }}</span>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Товары не найдены.</p>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links('pagination::simple-bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
