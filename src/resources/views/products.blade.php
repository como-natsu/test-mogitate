@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')

<div class="products">
    <div class="products__alert">
        @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('message'))
        <div class="alert-message">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="products-header">
        <h1 class="products-heading">
            @if(request ('name'))
            "{{ request('name')}}"の商品一覧
            @else
            商品一覧
            @endif
        </h1>
        <nav class="products-nav-wrapper">
            <ul class="products-nav">
                <li class="products-nav-item">
                    <a class="products-nav-link" href="/products/register">+ 商品を追加</a>
                </li>
            </ul>
        </nav>
    </div>


<div class="products-inner">
    <div class="products-main">
        <div class="products-sidebar">
            <form class="search-form" action="/products/search" method="get">
                @csrf
                <input class="search-form-input" type="text" name="name" placeholder="商品名で検索"
                    value="{{request('name')}}">
                <div class="search-form__actions">
                    <input class="search-form-search-btn btn" type="submit" value="検索">
                </div>
                <div class="price">
                    <label for="price-order">価格順で表示</label>
                    <select id="price-order" name="price_order">
                        <option value="">価格で並び替え</option>
                        <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                        <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>高い順に表示
                        </option>
                    </select>
                </div>
            </form>

            @if(request('price_order'))
            <div class="sort-tag">
                {{ request('price_order') == 'asc' ? '低い順に表示' : '高い順に表示' }}
                <a href="{{ route('products.search'). '?' . http_build_query(request()->except('price_order')) }}"
                    class="remove-tag">×</a>
            </div>
            @endif
        </div>

        <div class="products-content">
            <div class="products-list-wrapper">
                <ul class="product-list">
                    @foreach($products as $product)
                    <li class="product-item">
                        <a class="product-link" href="{{ url('products/' . $product->id) }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            <div class="product-info-row">
                                <p class="product-name">{{ $product->name }}</p>
                                <p class="product-price">￥{{ $product->price }}</p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="pagination-wrapper">
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection