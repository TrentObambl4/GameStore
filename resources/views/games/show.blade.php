@extends('layouts.app')

@section('content')

<div class="detail-page">

    <a href="{{ route('home') }}" class="back-link">
        ← Вернуться в каталог
    </a>


    <article class="game-detail">

        <div class="detail-cover">

            @if ($game->image)

                <img
                    src="{{ asset('storage/' . $game->image) }}"
                    alt="{{ $game->name }}"
                >

            @else

                <div class="cover-placeholder large">
                    <span>GAME</span>
                </div>

            @endif

        </div>


        <div class="detail-content">

            <span class="section-label">
                {{ $game->category->name }}
            </span>

            <h1>
                {{ $game->name }}
            </h1>

            <p class="detail-description">
                {{ $game->description }}
            </p>

            <div class="detail-price">
                {{ $game->price }} ₽
            </div>

            <div class="detail-meta">
                Продавец: <strong>{{ $game->user->login }}</strong>
            </div>

            <a href="{{ route('home') }}" class="btn btn-primary">
                ← В каталог
            </a>

        </div>

    </article>

</div>

@endsection
