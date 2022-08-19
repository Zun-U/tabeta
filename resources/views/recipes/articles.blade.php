@extends('layout')

@section('content')

<div class="container mt-4">
  <div class="search-box row justify-content-center">
    <div class="col-6">
      <div class="input-group">
        <input type="text" class="form-control search-input" placeholder="記事のタイトルを入力">
        <button class="btn btn-secondary">検索</button>
      </div>
    </div>
  </div>
</div>

@foreach($recipes->sortByDesc('created_at') as $recipe)
<div class="card shadow rounded-3 article-main" style="width: 30rem;">

  <div class="card-img-top"><img src="{{ $recipe->product_image }}" width="100%"></div>
  <div class="card-body">
    <div>
      <a href="{{ route('article.detail',$recipe) }}" class="card-link stretched-link"></a>
    </div>
    <div class="card-text">{{ $recipe->created_at }}</div>
    <div>
      <h5 class="card-title">{{ $recipe->title }}</h2>
    </div>
    <div class="card-text">{{ $recipe->howmany }}人分</div>
    <div class="card-text">調理時間：{{ $recipe->cooking_time }}分</div>
    <div class="card-text">対象年齢：{{ $recipe->ages }}</div>



    <div class="d-flex justify-content-end">
      <!-- いいね数表示 -->
      @if (!$recipe->isLikedBy(Auth::user()))
      <div class="me-3">
        <span>
          <i class="fa-solid fa-carrot"></i>
          <span class="like-counter">{{ ($recipe->likes_count == 0) ? "" : $recipe->likes_count }}</span>
        </span>
      </div>
      @else
      <div class="me-3">
        <span>
          <i class="fa-solid fa-carrot liked">たべた！</i>
          <span class="like-counter">{{ ($recipe->likes_count == 0) ? "" : $recipe->likes_count }}</span>
        </span>
      </div>
      @endif



      <!-- ブックマーク数表示 -->
      @if (!$recipe->isMarkedBy(Auth::user()))
      <div>
        <span>
          <i class="fa-solid fa-bookmark"></i>
          <span class="bookmark-counter">{{ ($recipe->favorites_count == 0) ? "" : $recipe->favorites_count }}</span>
        </span>
      </div>
      @else
      <div>
        <span>
          <i class="fa-solid fa-bookmark marked"></i>
          <span class="bookmark-counter">{{ ($recipe->favorites_count == 0) ? "" : $recipe->favorites_count }}</span>
        </span>
      </div>
      @endif
    </div>

  </div>


</div>

@endforeach




<div class="d-flex justify-content-center">
  {{ $recipes->links() }}
</div>
@endsection