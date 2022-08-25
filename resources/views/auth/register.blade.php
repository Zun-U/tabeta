@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="card">
                <div class="card-header">会員登録</div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス"/>
                            <label for="email">メールアドレス</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="ユーザー名"/>
                            <label for="name">ユーザー名</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="パスワード">
                            <label for="password">パスワード</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="パスワード（確認）">
                            <label for="password-confirm">パスワード（確認）</label>
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">送信</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection