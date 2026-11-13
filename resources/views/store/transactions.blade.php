@extends('layouts.app')
@section('content')
<div class="store-page">
    <div class="store-heading"><div><span class="section-label">АККАУНТ</span><h1>История операций</h1></div></div>
    <div class="store-panel">
        @forelse($transactions as $transaction)
            <div class="transaction-row">
                <div><strong>{{ $transaction->description ?: 'Операция с балансом' }}</strong><span>{{ $transaction->created_at->format('d.m.Y H:i') }}</span></div>
                <strong class="{{ (float)$transaction->amount >= 0 ? 'amount-positive' : 'amount-negative' }}">{{ (float)$transaction->amount > 0 ? '+' : '' }}{{ number_format((float)$transaction->amount,2,',',' ') }} ₽</strong>
            </div>
        @empty
            <div class="empty-state"><h3>Операций пока нет</h3><p>Пополнения и покупки будут отображаться здесь.</p></div>
        @endforelse
    </div>
</div>
@endsection
