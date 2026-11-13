@extends('layouts.app')

@section('content')
<div class="store-page">
    <div class="store-heading">
        <div><span class="section-label">АККАУНТ</span><h1>Баланс</h1>
            <p class="balance-intro">Управляйте виртуальными средствами для покупок в магазине.</p>
        </div>
        <a class="btn" href="{{ route('cart') }}">Перейти в корзину</a>
    </div>
    <section class="balance-page-card">
        <div class="balance-card-top">
            <span class="balance-card-caption">ТЕКУЩИЙ БАЛАНС</span>
            <span class="balance-card-symbol">₽</span>
        </div>
        <div class="balance-card-amount">{{ number_format((float) auth()->user()->balance, 2, ',', ' ') }} ₽</div>
        <p>Средства используются только внутри демонстрационного магазина.</p>
    </section>
    <section class="store-panel balance-form-panel">
        <h2>Пополнение баланса</h2>
        <p class="muted">Выберите сумму от 100 до 100 000 рублей.</p>
        <form method="POST" action="{{ route('balance.topup') }}" class="balance-page-form">
            @csrf
            <label for="amount">Сумма пополнения, ₽</label>
            <input id="amount" type="number" name="amount" min="100" max="100000" step="1" value="1000" required>
            <div class="balance-presets">
                <button type="button" data-amount="500">500 ₽</button>
                <button type="button" data-amount="1000">1 000 ₽</button>
                <button type="button" data-amount="3000">3 000 ₽</button>
                <button type="button" data-amount="5000">5 000 ₽</button>
            </div>
            <button class="btn btn-primary" type="submit">Пополнить баланс</button>
        </form>
    </section>
</div>
<script>
document.querySelectorAll('[data-amount]').forEach(function (button) {
    button.addEventListener('click', function () {
        document.getElementById('amount').value = button.dataset.amount;
    });
});
</script>
@endsection
