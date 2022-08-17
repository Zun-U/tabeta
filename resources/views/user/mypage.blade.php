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
      <spam class="btn btn-outline-secondary">
        編集
      <input type="file" name="profile_image" class="edit-image" value="" style="display:none" accept="image/*">
      </spam>
    </div>
  </form>
</div>


@endsection