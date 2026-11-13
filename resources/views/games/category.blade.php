@extends('layouts.app')

@section('content')

<div class="page-title">

    <span class="section-label">КАТЕГОРИЯ</span>

    <h1>
        {{ $category->name }}
    </h1>

    <p>
        Игры из выбранной категории.
    </p>

</div>


@if ($games->count() > 0)

    <div class="game-grid">

        @foreach ($games as $game)

            <article class="game-card game-card-clickable">
                    <a class="game-card-link" href="{{ route('game.show', $game) }}" aria-label="Открыть {{ $game->name }}"></a>

                <div class="game-cover">

                    @if ($game->image)

                        <img
                            src="{{ asset('storage/' . $game->image) }}"
                            alt="{{ $game->name }}"
                        >

                    @else

                        <div class="cover-placeholder">
                            <span>GAME</span>
                        </div>

                    @endif

                </div>


                <div class="game-card-body">

                    <div class="game-category">
                        {{ $category->name }}
                    </div>

                    <h3>
                        {{ $game->name }}
                    </h3>

                    <p>
                        {{ $game->description }}
                    </p>

                    <div class="game-card-bottom">

                        <strong class="game-price">
                            {{ $game->price }} ₽
                        </strong>

                        @auth
                                @if (auth()->user()->role->name === 'user')
                                    <form method="POST" action="{{ route('cart.add', $game) }}" class="card-cart-form">
                                        @csrf
                                        <button class="btn btn-small btn-primary" type="submit">В корзину</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-small">Войти для покупки</a>
                            @endauth

                    </div>

                </div>

            </article>

        @endforeach

    </div>

@else

    <div class="empty-state">

        <h3>В этой категории пока нет игр</h3>

        <a href="{{ route('home') }}" class="btn">
            Вернуться в каталог
        </a>

    </div>

@endif

@endsection
