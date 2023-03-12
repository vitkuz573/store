@extends('layouts.app')

@section('content')
    <div class="row mx-5">
        <div class="col-lg-12">
            <h1>Корзина</h1>
            <hr>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col-12">
            @if (count($cartItems) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Продукт</th>
                            <th scope="col">Стоимость</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Всего</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>
                                    <img src="{{ $cartItem->product->image_url }}" alt="{{ $cartItem->product->name }}" width="50px">
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
                            <td colspan="3" class="text-right"><strong>Всего:</strong></td>
                            <td>{{ $totalPrice }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-right mt-4">
                    <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger mx-2" onclick="return confirm('Вы уверены, что хотите очистить корзину?')">Очистить корзину</a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mx-2">Продолжить покупки</a>
                    <a href="{{ route('checkout') }}" class="btn btn-primary mx-2 my-2 my-md-0">Перейти к оформлению</a>
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

        .btn {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 30px;
            padding: 10px 20px;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
        }

        .btn-primary:hover {
            background-color: #3756b5;
            border-color: #3756b5;
            box-shadow: 0 8px 20px rgba(78, 115, 223, 0.4);
        }

        .btn-outline-danger {
            color: #e74a3b;
            border-color: #e74a3b;
            box-shadow: 0 5px 15px rgba(231, 74, 59, 0.4);
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #e74a3b;
            border-color: #e74a3b;
            box-shadow: 0 8px 20px rgba(231, 74, 59, 0.4);
        }

        .btn-secondary {
            background-color: #858796;
            border-color: #858796;
            box-shadow: 0 5px 15px rgba(133, 135, 150, 0.4);
        }

        .btn-secondary:hover {
            background-color: #6b6d7d;
            border-color: #6b6d7d;
            box-shadow: 0 8px 20px rgba(133, 135, 150, 0.4);
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (min-width: 768px) {
            .my-md-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
        }
    </style>
@endsection
