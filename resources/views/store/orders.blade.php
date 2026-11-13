@extends('layouts.app')

@section('content')
<div class="store-page">
    <div class="store-heading">
        <div><span class="section-label">АККАУНТ</span><h1>Мои покупки</h1></div>
        <a class="btn" href="{{ route('home') }}">В каталог</a>
    </div>

    @forelse ($orders as $order)
        <section class="store-panel order-panel">
            <div class="order-heading">
                <strong>Заказ №{{ $order->id }}</strong>
                <span>{{ $order->created_at->format('d.m.Y H:i') }}</span>
                <strong>{{ number_format((float) $order->total, 2, ',', ' ') }} ₽</strong>
            </div>
            @foreach ($order->items as $item)
                <div class="order-item">
                    <span>{{ $item->game_name }} × {{ $item->quantity }}</span>
                    <span>{{ number_format((float) $item->price * $item->quantity, 2, ',', ' ') }} ₽</span>
                </div>
            @endforeach
            <div class="order-status">Оплачен</div>
        </section>
    @empty
        <div class="store-panel empty-state"><h3>Покупок пока нет</h3><p>Оформленные заказы появятся здесь.</p></div>
    @endforelse
</div>
@endsection
