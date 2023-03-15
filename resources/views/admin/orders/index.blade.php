@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Управление заказами') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Пользователь') }}</th>
                                <th>{{ __('Адрес') }}</th>
                                <th>{{ __('Телефон') }}</th>
                                <th>{{ __('Сумма') }}</th>
                                <th>{{ __('Статус') }}</th>
                                <th>{{ __('Дата создания') }}</th>
                                <th>{{ __('Действия') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->shipping_address }}</td>
                                    <td>{{ $order->customer_phone }}</td>
                                    <td>{{ $order->total_price }} руб.</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary">{{ __('Просмотреть') }}</a>
                                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary ms-1">{{ __('Редактировать') }}</a>
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
