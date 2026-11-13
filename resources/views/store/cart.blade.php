@extends('layouts.app')

@section('content')
<div class="store-page">
    <div class="store-heading">
        <div><span class="section-label">ВАШИ ПОКУПКИ</span><h1>Корзина</h1></div>
        <a class="btn" href="{{ route('home') }}">Продолжить покупки</a>
    </div>

    @if ($items->isEmpty())
        <div class="store-panel empty-state"><h3>Корзина пока пуста</h3><p>Добавьте понравившиеся игры из каталога.</p></div>
    @else
        <div class="store-panel">
            @foreach ($items as $item)
                <div class="cart-row">
                    <div class="cart-game">
                        <strong>{{ $item->game?->name ?? 'Игра недоступна' }}</strong>
                        <span>{{ number_format((float) ($item->game?->price ?? 0), 2, ',', ' ') }} ₽ за шт.</span>
                    </div>
                    <form method="POST" action="{{ route('cart.update', $item) }}" class="quantity-form">
                        @csrf @method('PUT')
                        <input type="number" name="quantity" min="1" max="99" value="{{ $item->quantity }}">
                        <button class="btn btn-small" type="submit">Обновить</button>
                    </form>
                    <strong>{{ number_format((float) ($item->game?->price ?? 0) * $item->quantity, 2, ',', ' ') }} ₽</strong>
                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                        @csrf @method('DELETE')
                        <button class="text-button" type="submit">Удалить</button>
                    </form>
                </div>
            @endforeach
            <div class="cart-total">
                <span>Итого</span>
                <strong>{{ number_format($items->sum(fn ($item) => (float) ($item->game?->price ?? 0) * $item->quantity), 2, ',', ' ') }} ₽</strong>
            </div>
            <form method="POST" action="{{ route('cart.checkout') }}" class="checkout-form">
                @csrf
                <button class="btn btn-primary" type="submit">Оплатить с виртуального баланса</button>
            </form>
        </div>
    @endif

</div>
@endsection
