@extends('layout')

@section('content')

<div>
  <p>{{ Auth::user()->name }}さんのマイページ</p>
</div>

<div>
  <p>プロフィール画像</p>
</div>

<div>
  <img src="{{ Auth::user()->image }}" width="40px" height="40px">
</div>

<div>
  <form action="" method="POST" id="edit_image" enctype="multipart/form-data">
    <div>
      <input type="file" name="profile_image" class="edit-image" value="">
    </div>
  </form>
</div>


@endsection