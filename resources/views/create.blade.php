@extends('app')

@section('title', '商品新規登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
@section('content')
<div class="create__title">
    <h1>商品登録</h1>
</div><!-- /.create__title -->

<form action="{{ route('store') }}" method="post" class="create__form" enctype="multipart/form-data">
    @csrf
    <div class="create__form--group">
        <label for="product_name">商品名</label>
        <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}" placeholder="商品名を入力してください">
    </div><!-- /.create__form-group -->
    <div class="create__form--group">
        <label for="price">価格</label>
        <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="価格を入力してください">
    </div><!-- /.create__form-group -->
    <div class="create__form--group">
        <label for="description">商品説明</label>
        <textarea name="description" id="description" placeholder="商品説明を入力してください">{{ old('description') }}</textarea>
    </div><!-- /.create__form-group -->
    <div class="create__form--group">
        <label for="stock">在庫数</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" placeholder="在庫数を入力してください">
    </div><!-- /.create__form--group -->
    <div class="create__form--group">
        <label for="img_path">商品画像</label>
        <input type="file" name="img_path" id="img_path">
    </div><!-- /.create__form-group -->
    <div class="create__btns">
        <a href="{{ route('mypage') }}" class="btn btn-back">戻る</a>
        <button type="submit" class="btn create__btn--submit">登録</button>
    </div><!-- /.create__btns -->
    
</form>

@endsection