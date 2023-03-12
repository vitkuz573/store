@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Админ-панель') }}</div>

                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-users mr-2"></i> {{ __('Управление пользователями') }}
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-shopping-cart mr-2"></i> {{ __('Управление заказами') }}
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-boxes mr-2"></i> {{ __('Управление товарами') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .list-group-item-action:hover {
            background-color: #f2f2f2;
        }

        .list-group-item-action {
            border: none;
            border-bottom: 1px solid #ddd;
        }
    </style>
@endsection
