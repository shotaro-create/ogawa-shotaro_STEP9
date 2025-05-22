@extends('app')

@section('title', '商品購入画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase__title">
    <h1>購入画面</h1>
</div><!-- /.purchase__title -->

<form action="{{ route('purchase') }}" method="POST">
    @csrf
    <div class="purchase__form">
        <label for="product_name">商品名：</label>
        <p>{{ $product->product_name }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="product_description">説明：</label>
        <p>{{ $product->description }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="product__image">
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="number" name="quantity" id="quantity" placeholder="数量を入力" value="{{ old('quantity') }}">
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="price">金額：</label>
        <p>¥{{ $product->price }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="stock">残り：</label>
        <p>{{ $product->stock }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="company_name">会社名：</label>
        <p>{{ $product->company->company_name }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__btns">
        <button type="submit" class="btn purchase__btn">購入する</button>
        <a href="{{ route('product.detail', $product->id) }}" class="btn purchase__btn--back">戻る</a>
    </div><!-- /.purchase__btns -->
</form>

@endsection