@extends('app')

@section('title', '出品商品詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/listing_detail.css') }}">
@endsection

@section('content')
<div class="listing_detail__title">
    <h1>出品商品詳細</h1>
</div><!-- /.listing_detail__title -->

<div class="listing_detail__items">
    <p>商品名: {{ $product->product_name }}</p>
    <p>説明: {{ $product->description }}</p>
    <p>画像:</p>
    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="product__image">
    <p>金額: ¥{{ $product->price }}</p>
    <div class="listing_detail__btns">
        <a href="{{ route('listing.edit', $product->id) }}" class="btn listing_edit_btn">編集</a>
        <form action="{{ route('destroy', $product->id) }}" method="POST" class="listing_delete__form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn listing_delete_btn" onclick="return confirm('本当に削除しますか？');">削除</button>
        </form>
        <a href="{{ route('mypage') }}" class="btn back_btn">戻る</a>
    </div><!-- /.listing_detail__btns -->
</div><!-- /.listing_detail__items -->
@endsection