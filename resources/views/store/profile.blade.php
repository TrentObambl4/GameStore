@extends('layouts.app')
@section('content')
<div class="store-page">
    <div class="store-heading"><div><span class="section-label">АККАУНТ</span><h1>Личный кабинет</h1></div></div>
    <div class="profile-card">
        <div class="profile-avatar">{{ mb_strtoupper(mb_substr($user->login,0,1)) }}</div>
        <div><h2>{{ $user->login }}</h2><span class="muted">{{ $user->role->name === 'user' ? 'Покупатель' : ($user->role->name === 'seller' ? 'Продавец' : 'Администратор') }}</span>
        <p class="muted">В магазине с {{ $user->created_at->format('d.m.Y') }}</p></div>
    </div>
    <div class="profile-stats">
        <div class="store-panel"><span>Баланс</span><strong>{{ number_format((float)$user->balance,2,',',' ') }} ₽</strong></div>
        <div class="store-panel"><span>Заказов</span><strong>{{ $ordersCount }}</strong></div>
        <div class="store-panel"><span>Куплено игр</span><strong>{{ $gamesCount }}</strong></div>
    </div>
    <div class="profile-links">
        <a class="btn" href="{{ route('orders') }}">История заказов</a>
        <a class="btn" href="{{ route('transactions') }}">История операций</a>
        @if($user->role->name === 'user')
            <a class="btn" href="{{ route('library') }}">Библиотека</a>
            <a class="btn" href="{{ route('favorites') }}">Избранное</a>
        @endif
    </div>
</div>
@endsection
