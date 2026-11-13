@extends('layouts.app')

@section('content')

<div class="gs-admin-page">

    <div class="gs-admin-hero gs-admin-hero-inner">

        <div>

            <a
                href="{{ route('admin.index') }}"
                class="gs-admin-back"
            >
                ← Все продавцы
            </a>

            <div class="gs-admin-eyebrow">
                CATALOG / SELLER
            </div>

            <h1>{{ $user->login }}</h1>

            <p>
                Управление играми продавца
            </p>

        </div>

        <div class="gs-admin-stat">
            <span>Игр</span>
            <strong>{{ $games->count() }}</strong>
        </div>

    </div>


    <section class="gs-admin-section">

        @if ($games->count())

            <div class="gs-games-list">

                @foreach ($games as $game)

                    <article class="gs-game-card">

                        <div class="gs-game-cover">

                            @if ($game->image)

                                <img
                                    src="{{ asset($game->image) }}"
                                    alt="{{ $game->name }}"
                                >

                            @else

                                <div class="gs-game-no-cover">
                                    GAME
                                </div>

                            @endif

                        </div>


                        <div class="gs-game-body">

                            <div class="gs-game-heading">

                                <div class="gs-game-title">

                                    <h2>{{ $game->name }}</h2>

                                    <div class="gs-game-meta">

                                        <span>
                                            {{ $game->category->name ?? 'Без категории' }}
                                        </span>

                                        <i>•</i>

                                        <span>
                                            {{ number_format($game->price, 0, ',', ' ') }} ₽
                                        </span>

                                    </div>

                                </div>


                                @if ($game->published)

                                    <span class="gs-status gs-status-active">
                                        Опубликовано
                                    </span>

                                @else

                                    <span class="gs-status gs-status-blocked">
                                        Заблокировано
                                    </span>

                                @endif

                            </div>


                            <p class="gs-game-description">
                                {{ $game->description }}
                            </p>


                            <div class="gs-game-actions">

                                <a
                                    href="{{ route('admin.game.edit', $game) }}"
                                    class="gs-admin-btn gs-admin-btn-light"
                                >
                                    Редактировать
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('admin.game.toggle', $game) }}"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="gs-admin-btn gs-admin-btn-orange"
                                    >
                                        {{ $game->published ? 'Заблокировать' : 'Разблокировать' }}
                                    </button>

                                </form>


                                <form
                                    method="POST"
                                    action="{{ route('admin.game.destroy', $game) }}"
                                    onsubmit="return confirm('Удалить игру?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="gs-admin-btn gs-admin-btn-danger"
                                    >
                                        Удалить
                                    </button>

                                </form>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="gs-admin-empty">
                У этого продавца пока нет игр.
            </div>

        @endif

    </section>

</div>

@endsection