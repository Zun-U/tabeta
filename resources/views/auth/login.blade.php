@extends('layout')

@section('content')

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <p class="text-align-center">こどもの「たべない！」を「たべた！」に変える、お料理の工夫を共有するレシピ投稿サイトです。</p>
      <nav class="card">
        <div class="card-header">ログイン</div>
        <div class="card-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-floating">
              <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
              <label for="email">メールアドレス</label>
            </div>
            <div class="form-floating mt-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="パスワード">
              <label for="password">パスワード</label>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary mt-3">送信</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection