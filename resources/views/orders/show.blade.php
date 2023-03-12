@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Детали заказа</h1>

        <p><strong>Идентификатор заказа:</strong> {{ $order->id }}</p>
        <p><strong>Стоимость заказа:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} руб.</p>
        <p><strong>Статус заказа:</strong> {{ $order->status }}</p>

        <h2>Товары в заказе</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Общая стоимость</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
                <tr>
                    <td><a href="{{ route('products.show', $orderItem->product->id) }}">{{ $orderItem->product->name }}</a></td>
                    <td>{{ number_format($orderItem->price, 2, ',', ' ') }} руб.</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ number_format($orderItem->price * $orderItem->quantity, 2, ',', ' ') }} руб.</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h2>Информация о клиенте</h2>

        <p><strong>Имя клиента:</strong> {{ $order->customer_name }}</p>
        <p><strong>Email клиента:</strong> {{ $order->customer_email }}</p>
        <p><strong>Адрес доставки:</strong> {{ $order->shipping_address }}</p>

        <h2>Информация об оплате</h2>

        <p><strong>Способ оплаты:</strong>
            @if ($order->payment_method == 'cash')
                Оплата наличными при получении
            @elseif ($order->payment_method == 'card')
                Онлайн-оплата банковской картой
            @endif
        </p>

    </div>
@endsection
