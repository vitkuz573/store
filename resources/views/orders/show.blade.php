@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Детали заказа</h1>

        <p><strong>Идентификатор заказа:</strong> {{ $order->id }}</p>
        <p><strong>Стоимость заказа:</strong> ${{ $order->total_price }}</p>
        <p><strong>Статус заказа:</strong> {{ $order->status }}</p>

        <h2>Заказ</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Товар</th>
                <th>Стоимость</th>
                <th>Количество</th>
                <th>Итого</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
                <tr>
                    <td>{{ $orderItem->product->name }}</td>
                    <td>{{ $orderItem->price }} руб.</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ $orderItem->price * $orderItem->quantity }} руб.</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
