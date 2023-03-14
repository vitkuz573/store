@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Управление категориями') }}</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-success">{{ __('Создать категорию') }}</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Название') }}</th>
                                    <th>{{ __('Дата создания') }}</th>
                                    <th>{{ __('Действия') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">{{ __('Редактировать') }}</a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
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
