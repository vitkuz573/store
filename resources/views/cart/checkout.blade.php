@extends('layouts.app')

@section('content')
    <div class="row mx-5">
        <div class="col-lg-12">
            <h1>Оформление заказа</h1>
            <hr>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('checkout.place-order') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Адрес доставки</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                </div>
                <div class="form-group">
                    <label for="notes">Примечания к заказу</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Оформить заказ</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ваш заказ</h5>
                </div>
                <div class="card-body">
                    @foreach ($cartItems as $cartItem)
                        <p class="card-text">{{ $cartItem->product->name }} x {{ $cartItem->quantity }} - {{ $cartItem->product->price * $cartItem->quantity }} руб.</p>
                    @endforeach
                    <hr>
                    <p class="card-text"><strong>Итого:</strong> {{ $totalPrice }} руб.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
