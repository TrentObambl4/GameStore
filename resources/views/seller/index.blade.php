@extends('layouts.app')

@section('content')

<div class="dashboard">

    <div class="dashboard-header">

        <div>
            <span class="section-label">SELLER</span>
            <h1>Панель продавца</h1>
            <p>Управление вашими играми.</p>
        </div>

        <a href="{{ route('seller.create') }}" class="btn btn-primary">
            + Добавить игру
        </a>

    </div>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if ($games->count() > 0)

        <div class="dashboard-table">

            @foreach ($games as $game)

                <div class="dashboard-row">

                    <div class="dashboard-game">

                        <div class="mini-cover">
                            GAME
                        </div>

                        <div>
                            <strong>{{ $game->name }}</strong>

                            <span>
                                {{ $game->category->name }}
                            </span>
                        </div>

                    </div>


                    <div class="dashboard-price">
                        {{ $game->price }} ₽
                    </div>


                    <div>

                        @if ($game->published)
                            <span class="status status-active">
                                Опубликована
                            </span>
                        @else
                            <span class="status status-hidden">
                                Скрыта
                            </span>
                        @endif

                    </div>


                    <div class="row-actions">

                        <a
                            href="{{ route('seller.edit', $game) }}"
                            class="btn btn-small"
                        >
                            Изменить
                        </a>

                        <form
                            method="POST"
                            action="{{ route('seller.toggle', $game) }}"
                        >

                            @csrf

                            <button type="submit" class="btn btn-small btn-dark">
                                {{ $game->published ? 'Скрыть' : 'Опубликовать' }}
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-state">

            <h3>У вас пока нет игр</h3>

            <p>
                Добавьте первую игру в каталог.
            </p>

            <a href="{{ route('seller.create') }}" class="btn btn-primary">
                Добавить игру
            </a>

        </div>

    @endif

</div>

@endsection
