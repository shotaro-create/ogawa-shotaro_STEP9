@extends('app')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="product__title">
    <h1>商品一覧</h1>
</div><!-- /.product__title -->
<!-- 商品の検索 -->
<form action="{{ route('search') }}" method="GET" class="product__search">
    <div class="product__search--name">
        <input type="text" name="product_name" placeholder="商品名を入力" value="{{ request('product_name') }}">
    </div><!-- /.product__search--name -->
    <div class="product__search--minPrice">
        <input type="number" name="price_min" id="price_min" placeholder="最低価格" value="{{ request('price_min') }}">
    </div><!-- /.product__search--minPrice -->
    <span>〜</span>
    <div class="product__search--maxPrice">
        <input type="number" name="price_max" id="price)_max" placeholder="最高価格" value="{{ request('price_max') }}">
    </div><!-- /.product__search--maxPrice -->
    <div class="product__btn--group">
        <button type="submit" class="btn product__btn--search">検索</button>
    </div><!-- /.product__search--btn -->
</form>

<!-- 商品の一覧表示 -->
<table class="product__table">
    <tr>
        <th>商品番号</th>
        <th>商品名</th>
        <th>商品説明</th>
        <th>画像</th>
        <th>料金(¥)</th>
        <th></th>
    </tr>
    @forelse ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->description }}</td>
        <td>
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="product__image">
        </td>
        <td>{{ $product->price }}</td>
        <td><a href="{{ route('product.detail', $product->id ) }}" class="btn product__btn--listing_detail">詳細</a></td>
    </tr>
    @empty
    <tr class="product__no-data">
        <td colspan="6">該当する商品はありません</td>
    </tr>
    @endforelse
</table><!-- /.product__table -->
@endsection