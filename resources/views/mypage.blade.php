@extends('app')

@section('title', 'マイページ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="product__title">
    <h1>マイページ</h1>
</div><!-- /.product__title -->

<div class="product__btn">
    <a href="{{ route('account.edit') }}" class="btn btn__account--edit">アカウント編集</a>
</div><!-- /.product__btn -->
<div class="product__privates">
    <div class="product__private--info">
        <p>ユーザー名: {{ auth()->user()->user_name }}</p>
        <p>メールアドレス: {{ auth()->user()->email }}</p>
    </div><!-- /.private__user_name__email -->
    <div class="product__private--name">
        <p>名前: {{ auth()->user()->name_kanji }}</p>
        <p>カナ: {{ auth()->user()->name_kana }}</p>
    </div><!-- /.private__kanji__kana -->
</div><!-- /.product__private -->

<div class="product__title--listing">
    <h2>＜出品商品＞</h2>
</div><!-- /.product__title--listing -->

<div class="product__btn--create">
    <a href="{{ route('create') }}" class="btn btn__product--create">新規登録</a>
</div><!-- /.product__btn -->


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
            <!-- 画像の表示処理 -->
            @if ($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="product__image">
            @else
            <p>画像がありません</p>
            @endif
        </td>
        <td>{{ $product->price }}</td>
        <td><a href="{{ route('listing.detail', $product->id ) }}" class="btn product__btn--listing_detail">詳細</a></td>
    </tr>
    @empty
    <tr class="product__no-data">
        <td colspan="6">該当する商品はありません</td>
    </tr>
    @endforelse
</table><!-- /.product__table -->

<div class="product__title--purchase">
    <h2>＜購入した商品＞</h2>
</div><!-- /.product__title--purchase -->

<table class="product__table--purchase">
    <tr>
        <th>商品名</th>
        <th>商品説明</th>
        <th>料金(¥)</th>
        <th>個数</th>
    </tr>
    @forelse ($purchases as $purchase)
    <tr>
        <td>{{ $purchase->product->product_name }}</td>
        <td>{{ $purchase->product->description }}</td>
        <td>{{ $purchase->product->price }}</td>
        <td>{{ $purchase->quantity }}</td>
    </tr>
    @empty
    <tr class="product__no-data">
        <td colspan="4">購入した商品はありません</td>
    </tr>
    @endforelse
</table><!-- /.product__table -->
@endsection