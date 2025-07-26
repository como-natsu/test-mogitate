@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register">
    <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="form-group-title">
                <span class="form-label">商品名</span>
                <span class="form-label-required">必須</span>
            </div>
            <div class="form-group-content">
                <div class="form-input">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
                </div>
                <p class="form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group-title">
                <span class="form-la
                bel">値段</span>
                <span class="form-label-required">必須</span>
            </div>
            <div class="form-group-content">
                <div class="form-input">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
                </div>
                <p class="form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-title">
                <span class="form-label">商品画像</span>
                <span class="form-label-required">必須</span>
            </div>
            <div class="form-group-content">
                <div class="form-input">
                    <input type="file" name="image" />
                </div>
                <p class="form__error-message">
                    @error('image')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group-title">
                <span class="form-la
                bel">季節</span>
                <span class="form-label-required">必須</span>
                <span class="form-comment">複数選択可</span>
            </div>
            <div class="form-group-content">
                @php
                $selectedSeasonIds = old('season_id', []);
                @endphp
                <div class="form__season-inputs">
                    <div class="form__season-option">
                        <label class="form__season-label">
                            <input class="form__season-input" name="season_id" type="radio" value="1"
                                {{ old('season_id') == 1 ? 'checked' : '' }}>
                            <span class="form__season-text">春</span>
                        </label>
                    </div>

                    <div class="form__season-option">
                        <label class="form__season-label">
                            <input class="form__season-input" name="season_id" type="radio" value="2"
                                {{ old('season_id') == 2 ? 'checked' : '' }}>
                            <span class="form__season-text">夏</span>
                        </label>
                    </div>

                    <div class="form__season-option">
                        <label class="form__season-label">
                            <input class="form__season-input" name="season_id" type="radio" value="3"
                                {{ old('season_id') == 3 ? 'checked' : '' }}>
                            <span class="form__season-text">秋</span>
                        </label>
                    </div>

                    <div class="form__season-option">
                        <label class="form__season-label">
                            <input class="form__season-input" name="season_id" type="radio" value="4"
                                {{ old('season_id') == 4 ? 'checked' : '' }}>
                            <span class="form__season-text">冬</span>
                        </label>
                    </div>
                </div>
                <p class="form__error-message">
                    @error('season_id')
                    {{ $message }}
                    @enderror
                </p>

                <div class="form-group">
                    <div class="form-group-title">
                        <span class="form-label">商品説明</span>
                        <span class="form-label-required">必須</span>
                    </div>
                    <div class="form-group-content">
                        <textarea class="form__textarea" name="description" id="" cols="30" rows="10"
                            placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                        <p class="form__error-message">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                </div>
            </div>

            <div class="form-button">
                <a href="/products" class="form-button-revise">戻る</a>
                <button class="form-button-sumbit" type="submit">登録</button>
            </div>
    </form>
</div>
@endsection