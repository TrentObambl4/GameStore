@extends('layouts.app')
@section('content')
<div class="store-page">
    <div class="store-heading"><div><span class="section-label">ВАШ АККАУНТ</span><h1>Избранное</h1></div></div>
    @if($games->isEmpty())
        <div class="store-panel empty-state"><h3>Здесь пока пусто</h3><p>Добавляйте интересные игры в избранное из каталога.</p><a class="btn" href="{{ route('home') }}">Открыть каталог</a></div>
    @else
        <div class="game-grid">
            @foreach($games as $game)
                <article class="game-card game-card-clickable">
                    <a class="game-card-link" href="{{ route('game.show',$game) }}"></a>
                    <div class="game-cover">
                        @if($game->image)<img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}">@else<div class="cover-placeholder"><span>GAME</span></div>@endif
                    </div>
                    <div class="game-card-body">
                        <div class="game-category">{{ $game->category->name }}</div><h3>{{ $game->name }}</h3>
                        <div class="game-card-bottom"><strong class="game-price">{{ $game->price }} ₽</strong>
                            <form method="POST" action="{{ route('favorites.toggle',$game) }}">@csrf<button class="btn btn-small" type="submit">Убрать</button></form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
