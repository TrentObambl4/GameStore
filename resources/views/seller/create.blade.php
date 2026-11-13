@extends('layouts.app')

@section('content')

<div class="form-page">

    <div class="page-title">

        <span class="section-label">SELLER</span>

        <h1>Добавить игру</h1>

        <p>
            Заполните информацию о новой игре.
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
        action="{{ route('seller.store') }}"
        class="large-form"
    >

        @csrf


        <div class="form-group">

            <label for="name">
                Название игры
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
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
            >{{ old('description') }}</textarea>

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
                    value="{{ old('price') }}"
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

                    <option value="">
                        Выберите категорию
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>


        <div class="form-actions">

            <button type="submit" class="btn btn-primary">
                Добавить игру
            </button>

            <a href="{{ route('seller.index') }}" class="btn btn-dark">
                Отмена
            </a>

        </div>

    </form>

</div>

@endsection
