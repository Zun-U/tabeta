<!-- 各ページ共通の部分をまとめたファイル -->

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tabeta!</title>



    <link rel="stylesheet" href="/css/style.css">
</head>

<body>


    <!-- ヘッダーの出し分け -->
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/"><img src="{{ asset('images/tabeta!.png')}}" class="titlelogo"></a>
            <div class="my-navbar-control">

                @if(Auth::check())
                <a class="my-navbar-item" href="{{ route('recipes.create') }}">レシピ作成</a>
                <span class="my-navbar-item">{{ Auth::user()->name }}さん</span>
                ｜
                <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                    @csrf
                </form>

                <!-- 「ログインしていなければ」の処理 -->
                @else
                <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
                ｜
                <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
                @endif
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
</body>

</html>
