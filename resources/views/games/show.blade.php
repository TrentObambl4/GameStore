@extends('layouts.app')

@section('content')

<div class="gs-product-page">

    <div class="gs-product-topbar">
        <a href="{{ route('home') }}" class="gs-product-back">
            <span>←</span> Каталог игр
        </a>
        <span class="gs-product-breadcrumb">Магазин / {{ $game->category?->name ?? 'Игры' }}</span>
    </div>

    <article class="gs-product-card">

        <div class="gs-product-visual">
            @if ($game->image)
                <img
                    class="gs-product-cover"
                    src="{{ asset('storage/' . $game->image) }}"
                    alt="{{ $game->name }}"
                >
            @else
                <div class="gs-product-placeholder">
                    <span>GAME STORE</span>
                    <small>ИЗОБРАЖЕНИЕ ОТСУТСТВУЕТ</small>
                </div>
            @endif
        </div>

        <div class="gs-product-info">

            <div class="gs-product-tags">
                <span class="gs-product-category">
                    {{ $game->category?->name ?? 'Без категории' }}
                </span>
                <span class="gs-product-status">
                    <span></span> В наличии
                </span>
            </div>

            <h1>{{ $game->name }}</h1>

            <div class="gs-product-description">
                <h3>Об игре</h3>
                <p>{{ $game->description ?: 'Описание этой игры пока не добавлено.' }}</p>
            </div>

            <div class="gs-product-divider"></div>

            <div class="gs-product-bottom">

                <div class="gs-product-price-block">
                    <span class="gs-product-price-label">Стоимость</span>
                    <div class="gs-product-price">
                        {{ number_format((float) $game->price, 0, ',', ' ') }} ₽
                    </div>
                </div>

                <div class="gs-product-seller">
                    <span class="gs-seller-avatar">G</span>
                    <div>
                        <small>Продавец</small>
                        <strong>{{ $game->seller?->login ?? 'Game Store' }}</strong>
                    </div>
                </div>

            </div>

            @auth
                @if (auth()->user()->role->name === 'user')
                    <form method="POST" action="{{ route('cart.add', $game) }}" class="detail-cart-form">
                        @csrf
                        <button type="submit" class="gs-product-button">Добавить в корзину</button>
                        <a href="{{ route('cart') }}" class="gs-product-secondary">Перейти в корзину</a>
                    </form>
                @else
                    <a href="{{ route('home') }}" class="gs-product-button">← Вернуться в каталог</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="gs-product-button">Войти, чтобы купить</a>
            @endauth

            <div class="gs-product-note">
                Цифровой магазин компьютерных игр
            </div>

        </div>

    </article>

</div>

@endsection