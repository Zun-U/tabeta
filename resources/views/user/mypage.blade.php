@extends('layout')

@section('content')


<div class="container">
  <div class="row">

    <div>
      <p>{{ Auth::user()->name }}さんのマイページ</p>
    </div>

    <div>
      <p>プロフィール画像</p>
    </div>

    <div>
      <form action="" method="POST" id="edit_image" enctype="multipart/form-data">
        <label class="col-2">
          <!-- 三項演算子で画像が登録されていなければnoiconを乗せる。 -->
          <img src="{{ Auth::user()->image === null ? '/images/noimage.png' : Auth::user()->image }}" class="img-fluid w-75 rounded-circle">
          <div>
            <spam class="btn btn-outline-secondary">
              編集
              <input type="file" name="profile_image" class="edit-image" value="" style="display:none" accept="image/*">
            </spam>
          </div>
        </label>
      </form>
    </div>
  </div>
</div>


<div class="container">
  <div class="myarticle-group my-4 mt-5">
    投稿記事
  </div>
</div>

<div class="container d-flex">

  @foreach($mypages->recipes->sortByDesc('created_at') as $recipe)

  <div class="card shadow rounded-3 me-3" style="width: 18rem;">

    <div class="card-img-top">
      <img src="{{ $recipe->product_image }}" width="100%">
    </div>
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

</div>

<div class="myarticle-group my-4 mt-5 container">
    ブックマーク
  </div>

<div class="container d-flex">
  @foreach($mypages->recipes->sortByDesc('created_at') as $recipe)

  <div class="card shadow rounded-3 me-3" style="width: 18rem;">
    <div class="card-img-top">
      <img src="{{ $recipe->product_image }}" width="100%">
    </div>
    <div class="card-body">
      <div>
        <a href="{{ route('article.detail', $recipe) }}" class="card-link stretched-link"></a>
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
</div>

@endsection