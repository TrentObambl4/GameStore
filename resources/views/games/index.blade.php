@extends('layouts.app')

@section('content')

<section class="hero">

    <div class="hero-content">

        <div class="hero-label">
            GAME STORE
        </div>

        <h1>
            Игры, которые<br>
            хочется пройти
        </h1>

        <p>
            Каталог компьютерных игр разных жанров.
            Выбирайте игру, изучайте описание и переходите к подробной информации.
        </p>

        <a href="#catalog" class="btn btn-primary">
            Смотреть каталог
        </a>

    </div>

</section>


<section class="section">

    <div class="section-heading">

        <div>
            <span class="section-label">КАТАЛОГ</span>
            <h2>Категории</h2>
        </div>

    </div>

    <div class="category-grid">

        @foreach ($categories as $category)

            <a
                href="{{ route('category', $category) }}"
                class="category-card"
            >
                <span class="category-icon">›</span>

                <span>
                    <strong>{{ $category->name }}</strong>
                    <small>Смотреть игры</small>
                </span>
            </a>

        @endforeach

    </div>

</section>


<section class="section" id="catalog">

    <div class="section-heading">

        <div>
            <span class="section-label">ПОПУЛЯРНОЕ</span>
            <h2>Все игры</h2>
        </div>

        <span class="game-count">
            {{ $games->count() }} игр
        </span>

    </div>


    @if ($games->count() > 0)

        <div class="game-grid">

            @foreach ($games as $game)

                <article class="game-card">

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
                            {{ $game->category->name }}
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

                            <a
                                href="{{ route('game.show', $game) }}"
                                class="btn btn-small"
                            >
                                Подробнее
                            </a>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="empty-state">
            <h3>Игр пока нет</h3>
            <p>Каталог ещё не заполнен.</p>
        </div>

    @endif

</section>

@endsection
