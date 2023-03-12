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
                                    <input type="number" name="quantity" min="1" max="{{ $cartItem->product->stock }}" value="{{ $cartItem->quantity }}" data-product-id="{{ $cartItem->product->id }}">
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let removeFromCartButtons = document.querySelectorAll('.remove-from-cart');

            removeFromCartButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let productId = button.dataset.productId;

                    fetch("{{ route('cart.remove') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });

            let itemQuantityInputs = document.querySelectorAll('.item-quantity input');

            itemQuantityInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    let productId = input.dataset.productId;
                    let quantity = input.value;

                    fetch("{{ route('cart.update') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let price = data.price;
                                let itemTotal = document.querySelector('.item-total-' + productId);
                                itemTotal.textContent = price + ' руб.';

                                let totalPrice = data.total_price;
                                let totalPriceElement = document.querySelector('.total-price');
                                totalPriceElement.textContent = totalPrice + ' руб.';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
