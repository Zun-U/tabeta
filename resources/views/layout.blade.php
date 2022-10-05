<!-- 各ページ共通の部分をまとめたファイル -->

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tabeta!</title>

    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>


    <!-- ヘッダーの出し分け -->
    <header>
        <nav class="navbar navbar-expand-xl navbar-light pb-1 mb-1 shadow-sm  fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/tabeta!.png')}}" class="titlelogo"></a>

                <!-- レスポンシブ   -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <div class="navbar-control">

                        <ul class="navbar-nav ms-auto">
                            @if(Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="/">レシピ一覧</a>
                            </li>
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
                                <img src="{{ Auth::user()->image === null ? '/images/noimage.png' : Auth::user()->image }}" class="header-profile">
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
    <script src="{{ asset('../js/create_food.js') }}"></script>
    <script src="{{ asset('../js/like.js') }}"></script>
    <script src="{{ asset('../js/bookmark.js') }}"></script>
    <script src="{{ asset('../js/recipe_image.js') }}"></script>
    <script src="{{ asset('../js/edit_profile.js') }}"></script>
    <script src="{{ asset('../js/edit_food.js') }}"></script>
</body>

</html>