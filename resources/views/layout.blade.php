<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tabeta!</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <!-- ヘッダーの出し分け -->
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/"><img src="{{ asset('images/タイトルロゴ(仮).png') }}" alt="" class="titlelogo"></a>
            <div class="my-navbar-control">
                <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
            </div>
        </nav>
    </header>
</body>

</html>
