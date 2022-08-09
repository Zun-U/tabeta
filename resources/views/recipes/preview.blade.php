@extends('layout')

@section('content')

<a>テーブルに入力データを登録成功しました。</a>

@csrf

<div>
  <h1>{{ $recipes->title }}</h1>
</div>


@endsection