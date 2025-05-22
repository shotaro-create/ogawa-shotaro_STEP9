@extends('app')

@section('title', 'アカウント情報編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/account_edit.css') }}">
@endsection

@section('content')
<div class="account_edit__title">
    <h1>アカウント情報編集</h1>
</div><!-- /.account_edit__title -->

<form action="{{ route('account.update') }}" method="POST" class="account_edit__form">
    @csrf
    <div class="form-group">
        <label for="user_name">ユーザー名</label>
        <input type="text" name="user_name" id="user_name" value="{{ auth()->user()->user_name }}" class="form-control">
    </div><!-- /.form-group -->

    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="form-control">
    </div><!-- /.form-group -->

    <div class="form-group">
        <label for="name_kanji">名前</label>
        <input type="text" name="name_kanji" id="name_kanji" value="{{ auth()->user()->name_kanji }}" class="form-control">
    </div><!-- /.form-group -->

    <div class="form-group">
        <label for="name_kana">カナ</label>
        <input type="text" name="name_kana" id="name_kana" value="{{ auth()->user()->name_kana }}" class="form-control">
    </div><!-- /.form-group -->

    <div class="account_edit__btns">
        <a href="{{ route('mypage') }}" class="btn back-btn">戻る</a>
        <button type="submit" class="btn btn__account--edit">更新</button>
    </div><!-- /.account_edit__btns -->
</form>

@endsection