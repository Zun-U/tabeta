@extends('layout')

@section('content')

<div class="position-absolute top-10 start-50 translate-middle">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="記事のタイトルを入力">
    <button class="btn btn-secondary">検索</button>
  </div>
</div>

@foreach($recipes->sortByDesc('created_at') as $recipe)
<div class="card" style="width: 18rem;">

  <div class="card-img-top"><img src="{{ $recipe->product_image }}" width="50px" height="50px"></div>
  <div class="card-body">
    <a href="{{ route('article.detail',$recipe) }}" class="card-title">{{ $recipe->title }}</a>
    <div class="card-text">{{ $recipe->created_at }}</div>

    <div class="card-text">{{ $recipe->howmany }}人分</div>
    <div class="card-text">調理時間：{{ $recipe->cooking_time }}分</div>
    <div class="card-text">{{ $recipe->ages }}</div>




    <!-- いいね数表示 -->
    @if (!$recipe->isLikedBy(Auth::user()))
    <div>
      <span>
        <i class="fa-solid fa-carrot">たべた！</i>
        <span>{{ ($recipe->likes_count == 0) ? "" : $recipe->likes_count }}</span>
      </span>
    </div>
    @else
    <div>
      <span>
        <i class="fa-solid fa-carrot liked">たべた！</i>
        <span>{{ ($recipe->likes_count == 0) ? "" : $recipe->likes_count }}</span>
      </span>
    </div>
    @endif


    <!-- ブックマーク数表示 -->
    @if (!$recipe->isMarkedBy(Auth::user()))
    <div>
      <span >
        <i class="fa-solid fa-bookmark"></i>
        <span class=>{{ ($recipe->bookmarks_count == 0) ? "" : $recipe->bookmarks_count }}</span>
      </span>
    </div>
    @else
    <div>
      <span>
        <i class="fa-solid fa-bookmark marked"></i>
        <span>{{ ($recipe->bookmarks_count == 0) ? "" : $recipe->bookmarks_count }}</span>
      </span>
    </div>
    @endif
  </div>


</div>

@endforeach





{{ $recipes->links() }}

@endsection