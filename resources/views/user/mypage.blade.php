@extends('layout')

@section('content')

<!-- フラッシュメッセージ -->
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
  {{ session('flash_message') }}
</div>
@endif


<div class="container">
  <div class="row justify-content-center">
    <div class="col-2 align-self-center">
      <div class="mt-5 font-weight text-center">
        <p>プロフィール画像</p>
      </div>
      <form method="POST" id="edit_image" enctype="multipart/form-data">
        @csrf
        <label class="image-parent">
          <div class="edit-here">
            <!-- 三項演算子で画像が登録されていなければnoiconを乗せる。 -->
            <img src="{{ Auth::user()->image === null ? '/images/noimage.png' : Auth::user()->image }}" class="img-fluid prof-hover prof-image">
          </div>
          <!-- <div class="hide-message">クリックして編集</div> -->
          <div>
            <input type="file" name="profile_image" id="edit-profile" class="edit-image" value="" style="display:none" accept="image/*" />
          </div>
        </label>
        <div class="text-aline-center">
          <!-- <p> Auth::user()->name </p> -->
        </div>
      </form>
    </div>



    <!-- ユーザー情報編集 -->
    <div class="card col-4 mt-5">
      <div class="card-header">ユーザー情報変更</div>
      <div class="card-body">
        <form action="{{ route('user.edit')}}" method="POST" autocomplete="off">
          @csrf
          <div class="mt-2">
            <label class="form-label font-weight" for="name">名前</label>
            <input type="text" name="name" class="form-control" id="edit-name" value="{{ Auth::user()->name }}" />
          </div>
          <div class="mt-2">
            <label class="form-label font-weight" for="email">メールアドレス</label>
            <input type="text" name="email" class="form-control" id="edit-email" value="{{ Auth::user()->email }}" />
          </div>
          <div class="mt-2">
            <label class="form-label font-weight" for="password">パスワード</label>
            <span class="eyecon"><i class="fa-solid fa-eye-slash display-eye" id='input-group-addon'></i></span>
            <input type="password" name="password" class="form-control input-pass" id="edit-password" value="" readonly onfocus="this.removeAttribute('readonly');" />
          </div>
          <div class="font-weight mt-3 mb-3">
            <button type="submit" class="btn btn-success">変更</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-2 myarticle-group my-4 mt-5">
        投稿記事
      </div>

      <!-- 投稿レシピが４件以上なら表示 -->
      @if($mypages->sortByDesc('created_at')->count() >= 4)
      <div class="col-2 offset-md-8 my-4 mt-5">
        <a href="{{ route('my.recipe',Auth::user()->id) }}">投稿レシピ一覧</a>
      </div>
      @endif

    </div>
  </div>

  <div class="container d-flex">

    @foreach($mypages->sortByDesc('created_at') as $recipe)



    <div class="card shadow rounded-3 me-3 card-move mb-5" style="width: 18rem;">
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

        <div class="card-text">by<b class="name-font">{{ $recipe->users->name }}</b></div>


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

  <div class="container">
    <div class="row">
      <div class="col-2 myarticle-group my-4 mt-5">
        ブックマーク
      </div>
      @if($bookmarks->sortByDesc('created_at')->count() >= 4)
      <div class="col-2 offset-md-8 my-4 mt-5">
        <a href="{{ route('my.bookmark',Auth::user()->id) }}">ブックマーク一覧</a>
      </div>
      @endif
    </div>
  </div>

  <div class="container d-flex">

    @foreach($bookmarks->sortByDesc('created_at') as $bookmark)

    <div class="card shadow rounded-3 me-3 card-move mb-5" style="width: 18rem;">
      <div class="card-img-top">
        <img src="{{ $bookmark->product_image }}" width="100%">
      </div>
      <div class="card-body">
        <div>
          <a href="{{ route('article.detail', $bookmark) }}" class="card-link stretched-link"></a>
        </div>
        <div class="card-text">{{ $bookmark->created_at }}</div>
        <div>
          <h5 class="card-title">{{ $bookmark->title }}</h2>
        </div>
        <div class="card-text">{{ $bookmark->howmany }}人分</div>
        <div class="card-text">調理時間：{{ $bookmark->cooking_time }}分</div>
        <div class="card-text">対象年齢：{{ $bookmark->ages }}</div>

        <div class="card-text">by<b class="name-font">{{ $bookmark->users->name }}</b></div>


        <div class="d-flex justify-content-end">
          <!-- いいね数表示 -->
          @if (!$bookmark->isLikedBy(Auth::user()))
          <div class="me-3">
            <span>
              <i class="fa-solid fa-carrot"></i>
              <span class="like-counter">{{ ($bookmark->likes_count == 0) ? "" : $bookmark->likes_count }}</span>
            </span>
          </div>
          @else
          <div class="me-3">
            <span>
              <i class="fa-solid fa-carrot liked">たべた！</i>
              <span class="like-counter">{{ ($bookmark->likes_count == 0) ? "" : $bookmark->likes_count }}</span>
            </span>
          </div>
          @endif


          <!-- ブックマーク数表示 -->
          @if (!$bookmark->isMarkedBy(Auth::user()))
          <div>
            <span>
              <i class="fa-solid fa-bookmark"></i>
              <span class="bookmark-counter">{{ ($bookmark->favorites_count == 0) ? "" : $bookmark->favorites_count }}</span>
            </span>
          </div>
          @else
          <div>
            <span>
              <i class="fa-solid fa-bookmark marked"></i>
              <span class="bookmark-counter">{{ ($bookmark->favorites_count == 0) ? "" : $bookmark->favorites_count }}</span>
            </span>
          </div>
          @endif
        </div>

      </div>
    </div>
    @endforeach
  </div>

  @endsection