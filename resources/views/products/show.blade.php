@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <img src="{{ $product->image_url }}" class="w-100 rounded-3 shadow-lg mb-4" alt="{{ $product->name }} image">
            </div>
            <div class="col-lg-7">
                <div class="bg-white rounded-3 shadow-lg p-5">
                    <h1 class="text-primary mb-4">{{ $product->name }}</h1>
                    @if ($product->is_new)
                        <div class="badge bg-success mb-4">NEW!</div>
                    @endif
                    <p class="text-muted mb-4">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-primary mb-0">{{ $product->price }} руб.</h2>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">Add to Cart</button>
                        </form>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary px-4 rounded-pill">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #F9F9F9;
        }

        .badge {
            font-size: 1.2rem;
            padding: 0.5rem 0.75rem;
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #43A047;
            border-color: #43A047;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border-color: #4CAF50;
            color: #4CAF50;
            transition: all 0.2s;
        }

        .btn-outline-primary:hover {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: #FFF;
            transform: translateY(-2px);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .text-muted {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .text-primary {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
@endsection
