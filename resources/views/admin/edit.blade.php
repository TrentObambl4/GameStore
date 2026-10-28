@extends('layouts.app')

@section('content')
<div class="form-page">

    <a href="{{ route('admin.seller.games', $game->user_id) }}" class="back-link">
        в†ђ Р’РµСЂРЅСѓС‚СЊСЃСЏ Рє РёРіСЂР°Рј РїСЂРѕРґР°РІС†Р°
    </a>

    <div class="form-card">

        <span class="eyebrow">ADMIN</span>

        <h1>Р РµРґР°РєС‚РёСЂРѕРІР°РЅРёРµ РёРіСЂС‹</h1>

        <p class="form-subtitle">
            РџСЂРѕРґР°РІРµС†: <strong>{{ $game->seller->login }}</strong>
        </p>

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.game.update', $game) }}"
            class="game-form"
        >
            @csrf
            @method('PUT')

            <label>
                РќР°Р·РІР°РЅРёРµ РёРіСЂС‹
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $game->name) }}"
                    required
                >
            </label>

            <label>
                РљР°С‚РµРіРѕСЂРёСЏ
                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id', $game->category_id) == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Р¦РµРЅР°
                <input
                    type="number"
                    name="price"
                    value="{{ old('price', $game->price) }}"
                    min="0"
                    step="0.01"
                    required
                >
            </label>

            <label>
                РЎСЃС‹Р»РєР° РЅР° РёР·РѕР±СЂР°Р¶РµРЅРёРµ
                <input
                    type="text"
                    name="image"
                    value="{{ old('image', $game->image) }}"
                >
            </label>

            <label>
                РћРїРёСЃР°РЅРёРµ
                <textarea
                    name="description"
                    rows="8"
                    required
                >{{ old('description', $game->description) }}</textarea>
            </label>

            <button type="submit" class="button button-primary button-large">
                РЎРѕС…СЂР°РЅРёС‚СЊ РёР·РјРµРЅРµРЅРёСЏ
            </button>

        </form>

    </div>
</div>
@endsection

