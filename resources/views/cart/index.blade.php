@extends('layouts.app')

@section('content')
    <div class="row my-4">
        <div class="col-lg-12">
            <h1>Shopping Cart</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if (count($cartItems) > 0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>
                                <img src="{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }}" width="50px">
                                {{ $cartItem->product->name }}
                            </td>
                            <td>{{ $cartItem->product->price }}</td>
                            <td>
                                <input type="number" name="quantity" min="1" value="{{ $cartItem->quantity }}">
                            </td>
                            <td>{{ $cartItem->product->price * $cartItem->quantity }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                        <td>{{ $totalPrice }}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="text-right">
                    <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to clear your cart?')">Clear Cart</a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Continue Shopping</a>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>

            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
    </div>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            margin-right: 10px;
            vertical-align: middle;
        }

        input[type=number] {
            width: 50px;
        }
    </style>
@endsection
