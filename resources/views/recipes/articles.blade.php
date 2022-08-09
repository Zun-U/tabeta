@extends('layout')

@section('content')

<div class="position-absolute top-10 start-50 translate-middle">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="記事のタイトルを入力">
    <button class="btn btn-secondary">検索</button>
  </div>
</div>

<!-- ＠foreach($recipes as $recipe)
<div class="container">
  <div class="col-2">
    <a href="route('recipe.preview', $recipe)">$recipe->title </a>
    <div class="col-2"> $recipe->created_at </div>
  </div>
</div>
＠endforeach -->

@endsection