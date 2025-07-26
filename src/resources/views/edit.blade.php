@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('content')
<div class="product-edit">
    <form class="edit-form" action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="breadcrumb">
            <a href="{{ url('/products') }}">商品一覧</a> &gt; {{$product->name}}
        </div>
        <div class="form-group">
            <div class="form-group-content">
                <div class="form-input">
                    @if (!empty($product->image))
                    <div class="current-image">
                        <img src="{{ asset($product->image) }}" alt="登録済み画像" width="200">
                    </div>
                    @endif
                    <input type="file" name="image">
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
                <span class="form-label">商品名</span>
            </div>
            <div class="form-group-content">
                <div class="form-input">
                    <input type="text" name="name" value="{{ old('name', $product->name) }}">
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
            </div>
            <div class="form-group-content">
                <div class="form-input">
                    <input type="text" name="price" value="{{ old('price',$product->price) }}" />
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
                <span class="form-la
                bel">季節</span>
            </div>
            <div class="form-group-content">
                @php
                $selectedSeasonIds = $product->seasons->pluck('id')->toArray();
                @endphp
                <div class="form__season-inputs">
                    @foreach ($seasons as $season)
                    <div class="form__season-option">
                        <label class="form__season-label">
                            <input class="form__season-input" name="season_id[]" type="checkbox"
                                value="{{ $season->id }}"
                                {{ in_array($season->id, old('season_id', $selectedSeasonIds)) ? 'checked' : '' }}>
                            <span class="form__season-text">{{ $season->name }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="form__error-message">
                    @error('season_id')
                    {{ $message }}
                    @enderror
                </p>

                <div class="form-group">
                    <div class="form-group-title">
                        <span class="form-label">商品説明</span>
                    </div>
                    <div class="form-group-content">
                        <textarea class="form__textarea" name="description" id="" cols="30"
                            rows="10">{{ old('description',$product->description) }}</textarea>
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
                <button class="form-button-sumbit" type="submit">変更を保存</button>
            </div>
    </form>
    <div class="delete-form">
        <form action="/products/{{ $product->id }}/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
                <input type="hidden" name="id" value="{{ $product['id'] }}">
                <button class="delete-form-button-submit" type="submit">削除</button>
            </div>
        </form>
    </div>

</div>


@endsection