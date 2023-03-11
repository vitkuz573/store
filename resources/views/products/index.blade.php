@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
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
                        <h5 class="card-title fw-bold text-uppercase mb-2">{{ $product->name }}</h5>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="card-text text-primary fw-bold h5 mb-0">{{ $product->price }} руб.</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Подробнее</a>
                        </div>
                        <p class="card-text text-muted mt-2">{{ Str::limit($product->description, 100) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
@endsection

@section('styles')
    <style>
        .card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .card-body {
            position: relative;
            padding: 2rem;
            background-color: #fff;
        }
    </style>
@endsection
