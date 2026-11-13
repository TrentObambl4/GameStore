@extends('layouts.app')
@section('content')
<div class="store-page">
    <div class="store-heading"><div><span class="section-label">ВАШИ ИГРЫ</span><h1>Библиотека</h1><p class="balance-intro">Все игры, приобретённые в магазине.</p></div></div>
    @if($games->isEmpty())
        <div class="store-panel empty-state"><h3>Библиотека пока пуста</h3><p>После покупки игры появятся здесь.</p><a class="btn btn-primary" href="{{ route('home') }}">Перейти в каталог</a></div>
    @else
        <div class="game-grid">
            @foreach($games as $game)
                <article class="game-card game-card-clickable">
                    <a class="game-card-link" href="{{ route('game.show',$game) }}"></a>
                    <div class="game-cover">@if($game->image)<img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}">@else<div class="cover-placeholder"><span>GAME</span></div>@endif</div>
                    <div class="game-card-body"><div class="game-category">{{ $game->category->name }}</div><h3>{{ $game->name }}</h3><span class="library-owned">В вашей библиотеке</span></div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
