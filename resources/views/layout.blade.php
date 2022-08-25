<!-- 各ページ共通の部分をまとめたファイル -->

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tabeta!</title>

    <!-- jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ mix('/css/style.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>


    <!-- ヘッダーの出し分け -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light pb-1 mb-1 shadow-sm  fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/tabeta!.png')}}" class="titlelogo"></a>
                <div class="navbar-control">

                    <ul class="navbar-nav ms-auto">
                        @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mypage.show', Auth::user()->id) }}">マイページ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('recipes.create') }}">レシピ作成</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="logout" class="nav-link">ログアウト</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link active ms-2">{{ Auth::user()->name }}さん</span>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                        <!-- 「ログインしていなければ」の処理 -->
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">会員登録</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        @yield('content')
    </main>

    @if(Auth::check())
    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('logout-form').submit();
        });
    </script>
    @endif
    <script src="{{ asset('../js/pull_down.js') }}"></script>
    <script src="{{ asset('../js/edit_food.js') }}"></script>
    <script src="{{ asset('../js/like.js') }}"></script>
    <script src="{{ asset('../js/bookmark.js') }}"></script>
    <script src="{{ asset('../js/recipe_image.js') }}"></script>
    <script src="{{ asset('../js/edit_profile.js') }}"></script>
</body>

</html>