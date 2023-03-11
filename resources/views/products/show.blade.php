@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }} image">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text">{{ $product->price }} руб.</p>
        </div>
        <div class="card-footer bg-white">
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
@endsection
