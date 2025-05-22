@extends('app')

@section('title', 'お問い合わせフォーム')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact__title">
    <h1>お問い合わせフォーム</h1>
</div><!-- /.contact__title -->


<form action="{{ route('contact.submit') }}" method="POST" class="contact__form">
    @csrf
    <div class="contact__form--item">
        <label for="name">名前</label>
        <input type="text" name="name" id="name" placeholder="名前を入力してください" value="{{ old('name') }}">
    </div><!-- /.contact__form--item -->

    <div class="contact__form--item">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" placeholder="メールアドレスを入力してください" value="{{ old('email') }}">
    </div><!-- /.contact__form--i -->

    <div class="contact__form--item">
        <label for="message">お問い合わせ内容</label>
        <textarea name="message" id="message" placeholder="お問い合わせ内容を入力してください">{{ old('message') }}</textarea>
    </div><!-- /.contact__form--item -->

    <div class="contact__btns">
        <button type="submit" class="btn contact__btn--submit">送信</button>
        <a href="{{ route('index') }}" class="btn back-btn">戻る</a>
    </div><!-- /.contact__btns -->
</form>



@endsection