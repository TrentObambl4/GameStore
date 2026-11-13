@extends('layouts.app')

@section('content')

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-header">

            <span class="section-label">
                GAME STORE
            </span>

            <h1>Регистрация</h1>

            <p>
                Создайте новый аккаунт.
            </p>

        </div>


        @if ($errors->any())

            <div class="alert alert-error">

                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        <form method="POST" action="{{ route('register.store') }}" class="form-card">

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


            <div class="form-group">

                <label for="password_confirmation">
                    Повторите пароль
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                >

            </div>


            <button type="submit" class="btn btn-primary btn-full">
                Создать аккаунт
            </button>

        </form>


        <div class="auth-footer">

            Уже есть аккаунт?

            <a href="{{ route('login') }}">
                Войти
            </a>

        </div>

    </div>

</div>

@endsection
