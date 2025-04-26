@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Продукты iPhone</h1>
        </div>
        <div class="col-md-6 text-end">
            <form action="{{ route('products.fetch-iphones') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">Получить iPhone продукты</button>
            </form>
            <form action="{{ route('products.delete-iphones') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить iPhone продукты</button>
            </form>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info">
            Продукты не найдены. Нажмите кнопку "Получить iPhone продукты", чтобы загрузить продукты из API.
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        @if($product->thumbnail)
                            <img src="{{ $product->thumbnail }}" class="card-img-top product-image" alt="{{ $product->title }}">
                        @else
                            <div class="card-img-top product-image bg-light d-flex align-items-center justify-content-center">
                                <span class="text-muted">Нет изображения</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text text-muted">{{ $product->brand }}</p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Цена: ${{ number_format($product->price, 2) }}</li>
                            @if($product->discount_percentage)
                                <li class="list-group-item">Скидка: {{ $product->discount_percentage }}%</li>
                            @endif
                            <li class="list-group-item">Рейтинг: {{ $product->rating ?? 'Н/Д' }}</li>
                            <li class="list-group-item">В наличии: {{ $product->stock ?? 'Н/Д' }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
