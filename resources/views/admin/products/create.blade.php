@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Создание нового товара') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Название товара') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание товара') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Цена товара') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Количество товара') }}</label>

                                <div class="col-md-6">
                                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock">

                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="is_new" class="col-md-4 col-form-label text-md-right">{{ __('Новый товар') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="is_new" type="checkbox" class="form-check-input" name="is_new" {{ old('is_new') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_new">
                                            {{ __('Да') }}
                                        </label>
                                    </div>

                                    @error('is_new')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="image_url" class="col-md-4 col-form-label text-md-right">{{ __('URL изображения') }}</label>

                                <div class="col-md-6">
                                    <input id="image_url" type="text" class="form-control @error('image_url') is-invalid @enderror" name="image_url" value="{{ old('image_url') }}" required autocomplete="image_url">

                                    @error('image_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Создать товар') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
