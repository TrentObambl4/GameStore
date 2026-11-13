@extends('layouts.app')

@section('content')

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-header">
            <span class="section-label">GAME STORE</span>
            <h1>Вход</h1>
            <p>Войдите в свой аккаунт.</p>
        </div>


        @if ($errors->any())

            <div class="alert alert-error">

                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        <form method="POST" action="{{ route('login.store') }}" class="form-card">

            @csrf

            <div class="form-group">

                <label for="login">
                    Логин
                </label>

                <input
                    id="login"
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Пароль
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                >

            </div>


            <button type="submit" class="btn btn-primary btn-full">
                Войти
            </button>

        </form>


        <div class="auth-footer">
            Нет аккаунта?
            <a href="{{ route('register') }}">
                Зарегистрироваться
            </a>
        </div>

    </div>

</div>

@endsection
