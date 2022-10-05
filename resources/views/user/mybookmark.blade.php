@extends('layout')

@section('content')

<div class="mt-5"></div>

@foreach($mybookmarks->sortByDesc('created_at') as $mybookmark)
<div class="card shadow rounded-5 article-main">

  <div class="card-img-top"><img src="{{ $mybookmark->product_image }}"  class="card-image" width="100%"></div>
  <div class="card-body">
    <div>
      <a href="{{ route('article.detail',$mybookmark) }}" class="card-link stretched-link"></a>
    </div>
    <div class="card-text">{{ $mybookmark->created_at }}</div>
    <div>
      <h5 class="card-title">{{ $mybookmark->title }}</h2>
    </div>
    <div class="card-text">{{ $mybookmark->howmany }}人分</div>
    <div class="card-text">調理時間：{{ $mybookmark->cooking_time }}分</div>
    <div class="card-text">対象年齢：{{ $mybookmark->ages }}</div>

    <div class="card-text">by<b class="name-font">{{ $mybookmark->users->name }}</b></div>



    <div class="d-flex justify-content-end">
      <!-- いいね数表示 -->
      @if (!$mybookmark->isLikedBy(Auth::user()))
      <div class="me-3">
        <span>
          <i class="fa-solid fa-carrot"></i>
          <span class="like-counter">{{ ($mybookmark->likes_count == 0) ? "" : $mybookmark->likes_count }}</span>
        </span>
      </div>
      @else
      <div class="me-3">
        <span>
          <i class="fa-solid fa-carrot liked">たべた！</i>
          <span class="like-counter">{{ ($mybookmark->likes_count == 0) ? "" : $mybookmark->likes_count }}</span>
        </span>
      </div>
      @endif



      <!-- ブックマーク数表示 -->
      @if (!$mybookmark->isMarkedBy(Auth::user()))
      <div>
        <span>
          <i class="fa-solid fa-bookmark"></i>
          <span class="bookmark-counter">{{ ($mybookmark->favorites_count == 0) ? "" : $mybookmark->favorites_count }}</span>
        </span>
      </div>
      @else
      <div>
        <span>
          <i class="fa-solid fa-bookmark marked"></i>
          <span class="bookmark-counter">{{ ($mybookmark->favorites_count == 0) ? "" : $mybookmark->favorites_count }}</span>
        </span>
      </div>
      @endif
    </div>

  </div>


</div>

@endforeach




<div class="d-flex justify-content-center">
  {{ $mybookmarks->links() }}
</div>
@endsection