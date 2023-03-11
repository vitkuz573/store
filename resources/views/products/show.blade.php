@extends('layouts.app')

@section('content')
    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="{{ $product->image_url }}" class="card-img-top h-100" alt="{{ $product->name }} image">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h2 class="card-title">{{ $product->name }}</h2>
                    @if ($product->is_new)
                        <p class="card-text text-success font-weight-bold">NEW!</p>
                    @endif
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text h3">{{ $product->price }} руб.</p>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Add to Cart</button>
                        </form>
                    </div>
                    <div>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card-img-top {
            object-fit: cover;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .card-footer {
            border-top: none;
            padding: 1.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-primary:focus {
            box-shadow: none;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:focus {
            box-shadow: none;
        }

        .text-success {
            color: #28a745;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>
@endsection
