@extends('layouts.app')

@section('content')
    <div class="row mx-5">
        <div class="col-lg-12">
            <h1>Заказы</h1>
            <hr>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col-12">
            @if (count($orders) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Пользователь</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Статус</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d.m.Y H:i:s') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->total_price }} руб.</td>
                                <td>{{ $order->status }}</td>
                                <td class="text-right">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">Посмотреть</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            @else
                <p>Нет заказов.</p>
            @endif
        </div>
    </div>
@endsection
