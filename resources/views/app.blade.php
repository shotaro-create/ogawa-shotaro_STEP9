<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cytech EC')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <!-- ヘッダー -->
    <header>
        <div class="container header__container">
            <div class="header__title">
                <h1>Cytech EC</h1>
            </div><!-- /.header__title -->
            <div class="header__menu">
                <ul class="header__list">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('mypage') }}">マイページ</a></li>
                    <li>ログインユーザー: {{ auth()->user()->user_name }}</li>
                </ul><!-- /.header__list -->
                <div class="header__btn">
                    <form id="logout-form" action="{{route('logout') }}" method="POST">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" class="btn header__btn--logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a><!-- /.btn header__btn--logout -->
                </div><!-- /.header__btn -->
            </div><!-- /.header__menu -->
        </div><!-- /.container -->
    </header>

    <!-- メイン -->
    <main>
        <div class="container main__container">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="main__content">
                @yield('content')
            </div><!-- /.main__content -->
        </div><!-- /.container -->

    </main>

    <!-- フッター -->
    <footer>
        <div class="container footer__container">
            <div class="footer__items">
                <a href="{{ route('contact.form') }}" class="btn footer__btn--form">お問い合わせ</a>
                <ul class="footer__list">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('mypage') }}">マイページ</a></li>
                </ul><!-- /.footer__list -->
            </div><!-- /.footer__items -->
            <p class="footer__copy">&copy; 2024 Company, Inc</p>
        </div><!-- /.container -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>