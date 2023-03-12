@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <img src="{{ $product->image_url }}" class="w-100 rounded-3 shadow-lg" alt="{{ $product->name }} image" aria-label="{{ $product->name }} image">
            </div>
            <div class="col-lg-7">
                <div class="bg-white rounded-3 shadow-lg p-5 h-100">
                    <h1 class="text-primary mb-4">{{ $product->name }}</h1>
                    @if ($product->is_new)
                        <span class="badge bg-success mb-4">NEW!</span>
                    @endif
                    <p class="text-muted mb-4">{{ $product->description }}</p>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                        <h2 class="text-primary mb-0">{{ $product->price }} руб.</h2>
                        <form method="POST" action="{{ route('cart.add', $product) }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" aria-label="Quantity" required>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill mt-3 mt-md-0 ms-md-3">Добавить в корзину</button>
                                @if ($errors->has('quantity'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('quantity') }}
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary px-4 rounded-pill mt-auto">Назад к продуктам</a>
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
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            transition: all 0.2s;
        }

        .btn-outline-primary:hover {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: #FFF;
            transform: translateY(-2px);
        }

        .text-muted {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .text-primary {
            font-size: 2rem;
            font-weight: bold;
        }

        .h-100 {
            height: 100%;
        }
    </style>
@endsection
