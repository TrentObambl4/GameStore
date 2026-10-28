<header class="site-header">

    <div class="header-inner">

        <a href="{{ route('home') }}" class="logo">
            GAME STORE
        </a>

        <nav class="main-nav">

            <a href="{{ route('home') }}">
                Главная
            </a>

            @auth

                @if (auth()->user()->role->name === 'seller')
                    <a href="{{ route('seller.index') }}">
                        Продавец
                    </a>
                @endif

                @if (auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.index') }}">
                        Администратор
                    </a>
                @endif

                <span class="user-badge">
                    {{ auth()->user()->login }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-button">
                        Выйти
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}">
                    Войти
                </a>

                <a href="{{ route('register') }}" class="nav-register">
                    Регистрация
                </a>

            @endauth

        </nav>

    </div>

</header>
