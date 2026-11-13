@extends('layouts.app')

@section('content')

<div class="gs-admin-page">

    <div class="gs-admin-hero">

        <div>
            <div class="gs-admin-eyebrow">
                GAME STORE / ADMIN
            </div>

            <h1>Администратор</h1>

            <p>
                Управление продавцами и каталогом игр
            </p>
        </div>

        <div class="gs-admin-stat">
            <span>Продавцов</span>
            <strong>{{ $sellers->count() }}</strong>
        </div>

    </div>


    <section class="gs-admin-section">

        <div class="gs-section-title">

            <div>
                <h2>Продавцы</h2>
                <p>Выберите продавца, чтобы открыть его каталог.</p>
            </div>

        </div>


        @if ($sellers->count())

            <div class="gs-sellers-grid">

                @foreach ($sellers as $seller)

                    <article class="gs-seller-card">

                        <div class="gs-seller-top">

                            <div class="gs-seller-avatar">
                                {{ mb_strtoupper(mb_substr($seller->login, 0, 1)) }}
                            </div>

                            <div class="gs-seller-name">
                                <h3>{{ $seller->login }}</h3>
                                <span>Продавец</span>
                            </div>

                        </div>


                        <div class="gs-seller-bottom">

                            <div class="gs-seller-count">
                                <strong>{{ $seller->games_count }}</strong>
                                <span>
                                    {{ $seller->games_count == 1 ? 'игра' : ($seller->games_count < 5 ? 'игры' : 'игр') }}
                                </span>
                            </div>


                            <a
                                href="{{ route('admin.seller.games', $seller) }}"
                                class="gs-admin-btn gs-admin-btn-light"
                            >
                                Открыть каталог
                                <span>→</span>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="gs-admin-empty">
                Продавцов пока нет.
            </div>

        @endif

    </section>

</div>

@endsection