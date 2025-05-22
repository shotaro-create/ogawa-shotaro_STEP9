@extends('app')
@php
    $likeCount = $product->likes()->count();
@endphp
@section('title', '商品詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endsection

@section('content')
<!-- CSRFトークンをJavaScriptで使用するためのメタタグ -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Font Awesomeの読み込み -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!-- 外部JavaScriptファイルの読み込み -->
<script src="{{ asset('js/like.js') }}"></script>



<div class="product_detail__title">
    <h1>商品詳細</h1>
</div><!-- /.product_detail__title -->

<div class="product_detail__items">
    <p>商品名: {{ $product->product_name }}</p>
    <p>説明: {{ $product->description }}</p>
    <p>画像:</p>
    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="product__image">
    <p>金額: ¥{{ $product->price }}</p>
    <p>会社: {{ $product->company->company_name }}</p>

    <!-- いいねボタン -->
    <div class="product_detail__btn--like">
        <button id="like-btn" class="like-btn" data-product-id="{{ $product->id }}" @if($product->likedBy(Auth::user())) style="color: red;" @else style="color: gray;" @endif> <!-- Font Awesomeのハートアイコン -->
            <i class="fas fa-heart"></i>
        </button>
        @if ($likeCount > 0)
        <span id="like-count">{{ $likeCount }}</span>
        @endif
    </div><!-- /.product_detail__btn--like -->

    <div class="product_detail__btns">
        <a href="{{ route('purchase.show', $product->id) }}" class="btn product_cart_btn">カートに追加する</a>
        <a href="{{ route('index') }}" class="btn back_btn">戻る</a>
    </div><!-- /.product_detail__btns -->
</div><!-- /.product_detail__items -->
@endsection