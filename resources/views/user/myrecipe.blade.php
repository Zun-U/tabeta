@extends('layout')

@section('content')

<div class="mt-5"></div>

@foreach($myrecipes->sortByDesc('created_at') as $myrecipe)
<div class="card shadow rounded-3 article-main" style="width: 30rem;">

  <div class="card-img-top"><img src="{{ $myrecipe->product_image }}" width="100%"></div>
  <div class="card-body">
    <div>
      <a href="{{ route('article.detail',$myrecipe) }}" class="card-link stretched-link"></a>
    </div>
    <div class="card-text">{{ $myrecipe->created_at }}</div>
    <div>
      <h5 class="card-title">{{ $myrecipe->title }}</h2>
    </div>
    <div class="card-text">{{ $myrecipe->howmany }}人分</div>
    <div class="card-text">調理時間：{{ $myrecipe->cooking_time }}分</div>
    <div class="card-text">対象年齢：{{ $myrecipe->ages }}</div>

    <div class="card-text">by<b class="name-font">{{ $myrecipe->users->name }}</b></div>



    <div class="d-flex justify-content-end">
      <!-- いいね数表示 -->
      @if (!$myrecipe->isLikedBy(Auth::user()))
      <div class="me-3">
        <span>
          <i class="fa-solid fa-carrot"></i>
          <span class="like-counter">{{ ($myrecipe->likes_count == 0) ? "" : $myrecipe->likes_count }}</span>
        </span>
      </div>
      @else
      <div class="me-3">
        <span>
          <i class="fa-solid fa-carrot liked">たべた！</i>
          <span class="like-counter">{{ ($myrecipe->likes_count == 0) ? "" : $myrecipe->likes_count }}</span>
        </span>
      </div>
      @endif



      <!-- ブックマーク数表示 -->
      @if (!$myrecipe->isMarkedBy(Auth::user()))
      <div>
        <span>
          <i class="fa-solid fa-bookmark"></i>
          <span class="bookmark-counter">{{ ($myrecipe->favorites_count == 0) ? "" : $myrecipe->favorites_count }}</span>
        </span>
      </div>
      @else
      <div>
        <span>
          <i class="fa-solid fa-bookmark marked"></i>
          <span class="bookmark-counter">{{ ($myrecipe->favorites_count == 0) ? "" : $myrecipe->favorites_count }}</span>
        </span>
      </div>
      @endif
    </div>

  </div>


</div>

@endforeach




<div class="d-flex justify-content-center">
  {{ $myrecipes->links() }}
</div>
@endsection