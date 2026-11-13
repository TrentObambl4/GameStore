@extends('layouts.app')

@section('content')

<div class="form-page">

    <div class="page-title">

        <span class="section-label">SELLER</span>

        <h1>Редактировать игру</h1>

        <p>
            Изменение информации об игре.
        </p>

    </div>


    @if ($errors->any())

        <div class="alert alert-error">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('seller.update', $game) }}"
        class="large-form"
    >

        @csrf
        @method('PUT')


        <div class="form-group">

            <label for="name">
                Название игры
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $game->name) }}"
                required
            >

        </div>


        <div class="form-group">

            <label for="description">
                Описание
            </label>

            <textarea
                id="description"
                name="description"
                required
            >{{ old('description', $game->description) }}</textarea>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label for="price">
                    Цена
                </label>

                <input
                    id="price"
                    type="number"
                    step="0.01"
                    min="0"
                    name="price"
                    value="{{ old('price', $game->price) }}"
                    required
                >

            </div>


            <div class="form-group">

                <label for="category_id">
                    Категория
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    required
                >

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected($game->category_id == $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>


        <div class="form-actions">

            <button type="submit" class="btn btn-primary">
                Сохранить изменения
            </button>

            <a href="{{ route('seller.index') }}" class="btn btn-dark">
                Отмена
            </a>

        </div>

    </form>

</div>

@endsection
