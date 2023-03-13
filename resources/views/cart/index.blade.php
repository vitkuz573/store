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
                            <th scope="col">Итого</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr id="cart-item-{{ $cartItem->product->id }}">
                                <td>
                                    <img src="{{ $cartItem->product->image_url }}" alt="{{ $cartItem->product->name }}" width="50px">
                                    {{ $cartItem->product->name }}
                                </td>
                                <td class="item-price">{{ $cartItem->product->price }} руб.</td>
                                <td class="item-quantity">
                                    <form class="update-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
                                        <input type="number" name="quantity" min="1" max="{{ $cartItem->product->stock }}" value="{{ $cartItem->quantity }}" data-product-id="{{ $cartItem->product->id }}" class="item-quantity">
                                    </form>
                                </td>
                                <td class="item-total item-total-{{ $cartItem->product->id }}">{{ $cartItem->product->price * $cartItem->quantity }} руб.</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger remove-from-cart" data-product-id="{{ $cartItem->product->id }}">Удалить</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right"><strong>Итого:</strong></td>
                            <td class="total-price">{{ $totalPrice }} руб.</td>
                            <td></td>
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
                <p>Ваша корзина пуста.</p>
            @endif
        </div>
    </div>
@endsection
