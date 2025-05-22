@extends('app')

@section('title', '出品商品編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/listing_edit.css') }}">
@endsection

@section('content')
<div class="listing_edit__title">
    <h1>出品商品編集</h1>
</div><!-- /.listing_edit__title -->

{{-- 編集フォーム --}}
<form action="{{ route('update', $product->id) }}" method="post" class="listing_edit__form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    {{-- タイトル入力フィールド --}}
    <div class="listing_edit__form-group">
        <label for="product_name">商品名</label>
        <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}">
    </div><!-- /.listing_edit__form-group -->
    {{-- 価格入力フィールド --}}
    <div class="listing_edit__form-group">
        <label for="price">価格</label>
        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
    </div><!-- /.listing_edit__form-group -->
    {{-- 商品説明入力フィールド --}}
    <div class="listing_edit__form-group">
        <label for="description">商品説明</label>
        <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
    </div><!-- /.listing_edit__form-group -->
    {{-- 在庫数入力フィールド --}}
    <div class="listing_edit__form-group">
        <label for="stock">在庫数</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}">
    </div><!-- /.listing_edit__form-group -->
    {{-- 現在の商品画像の表示セクション --}}
    @if ($product->img_path)
    <div class="listing_edit__form-group">
        <label>現在の商品画像</label>
        <div>
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="Current Image">
        </div><!-- /.listing_edit__form-group -->
    </div>
    @endif
    {{-- 商品画像のアップロードフィールド --}}
    <div class="listing_edit__form-group">
        <label for="img_path">画像をアップロード</label>
        <input type="file" name="img_path" id="img_path">
    </div><!-- /.listing_edit__form-group -->
    <div class="listing_edit__btns">
        <a href="{{ route('listing.detail', $product->id) }}" class="btn btn-back">戻る</a>
        <button type="submit" class="btn listing_edit__btn--submit">更新する</button>
</form>



@endsection