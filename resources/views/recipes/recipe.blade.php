@extends('layout')

@section('content')




<div class="container mt-5">

  <!-- 編集ボタン -->
  @if(Auth::user()->id === $recipe_detail->user_id)
  <div class="btn btn-outline-success mb-5">
    <a href="{{ route('recipe.edit',$recipe_detail) }}">レシピの編集</a>
  </div>
  @endif

  <div class="row gx-5">
    <div class="col-md">
      <img src="{{ $recipe_detail->product_image }}" class="img-fluid px-2 rounded-3" height="250">
    </div>
    <div class="col-md text-area">
      <div>
        <h2 class="py-1">{{ $recipe_detail->title }}</h2>
      </div>
      <div>
        <h4 class="py-2">{{ $recipe_detail->subtitle }}</h4>
      </div>



      <!-- 投稿ユーザー -->
      <div class="d-flex justify-content-end mb-4">
        <div>
          <img src="{{ $user_recipe->image }}" class="recipe-user">
        </div>
        <div class="user-name">{{ $user_recipe->name }}</div>
      </div>


      <!-- いいね機能 -->
      <!-- ログインユーザーでいいねの押されていない投稿 -->
      <div class="d-flex justify-content-end">
        @if (!$recipe_detail->isLikedBy(Auth::user()))
        <div class="me-3">
          <span class="likes">
            <!-- カスタムデータ属性を設定 -->
            <i class="fa-solid fa-carrot like-toggle icon-hover" data-recipe-id="{{ $recipe_detail->id }}">たべた！</i>
            <!-- いいねカウンター表示 -->
            <span class="like-counter">{{ ($recipe_detail->likes_count == 0) ? "" : $recipe_detail->likes_count }}</span>
          </span>
        </div>

        <!-- いいねの既に押された投稿 -->
        @else
        <div class="me-3">
          <span class="likes">
            <i class="fa-solid fa-carrot like-toggle icon-hover liked" data-recipe-id="{{ $recipe_detail->id }}">たべた！</i>
            <span class="like-counter">{{ ($recipe_detail->likes_count == 0) ? "" : $recipe_detail->likes_count }}</span>
          </span>
        </div>
        @endif


        <!-- ブックマーク機能 -->
        @if (!$recipe_detail->isMarkedBy(Auth::user()))
        <div>
          <span class="markes">
            <i class="fa-solid fa-bookmark bookmark-toggle icon-hover" data-recipes-id="{{ $recipe_detail->id }}"></i>
            <span class="mark-counter">{{ ($recipe_detail->favorites_count == 0) ? "" : $recipe_detail->favorites_count }}</span>
          </span>
        </div>
        @else
        <div>
          <span class="markes">
            <i class="fa-solid fa-bookmark bookmark-toggle icon-hover marked" data-recipes-id="{{ $recipe_detail->id }}"></i>
            <span class="mark-counter">{{ ($recipe_detail->favorites_count == 0) ? "" : $recipe_detail->favorites_count }}</span>
          </span>
        </div>
        @endif
      </div>

      <div class="d-flex justify-content-end pt-3">
        <div class="border-bottom">
          <span>
            <i class="fa-regular fa-clock px-2"></i>{{ $recipe_detail->cooking_time }}分
          </span>
        </div>
        <div class="border-bottom">
          <span>
            <i class="fa-solid fa-child px-2 ms-3"></i>{{ $recipe_detail->ages }}
          </span>
        </div>
      </div>

      <div class="row py-2 mt-4">
        <div class="border-bottom border-secondary">
          <h5> 材料({{ $recipe_detail->howmany }}名分)</h5>
        </div>
      </div>

      @foreach($recipe_detail->foodstuffs as $foodstuff)
      <div class="row border-bottom">
        <div class="col py-2 mt-2">
          <span>{{ $foodstuff->food }}</span>
        </div>
        <div class="col text-end py-2 mt-2">
          <span>{{ $foodstuff->amount }}</span>
        </div>
      </div>
      @endforeach

    </div>



    <div class="container">
      <div class="row pt-4 my-4">
        <div class="pb-3">
          <h4>作り方</h4>
        </div>
        @foreach($recipe_detail->contents as $key=>$content)
        <div class="card border-0" style="width: 15rem;">
          <div class="serial-number">
            {{ $key+1 }}
          </div>
          <div class="card-img-top mt-3">
            <img src="{{ $content->recipe_image }}" width="100%" class="rounded-3">
          </div>
          <div class="card-body">
            <div class="card-text">
              {{ $content->content }}
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>





@endsection