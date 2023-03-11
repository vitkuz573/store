@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
            <div class="col mb-4">
                <div class="card h-100">
                    <a href="{{ route('products.show', $product) }}" class="stretched-link"></a>
                    @if($product->is_new)
                        <div class="card-badge bg-primary">New!</div>
                    @endif
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }} image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <p class="card-text text-muted mb-0">{{ $product->price }} руб.</p>
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
