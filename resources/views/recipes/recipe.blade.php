@extends('layout')

@section('content')


<div class="container">
  <div class="row gx-5">
    <div class="col mt-5">
      <img src="{{ $recipe_detail->product_image }}" class="img-fluid px-2">
    </div>
    <div class="col pt-5">
      <div>
        <h2 class="py-1">{{ $recipe_detail->title }}</h2>
      </div>
      <div>
        <h4 class="py-2">{{ $recipe_detail->subtitle }}</h4>
      </div>


      <!-- いいね機能 -->
      <!-- ログインユーザーでいいねの押されていない投稿 -->
      @if (!$recipe_detail->isLikedBy(Auth::user()))
      <div>
        <span class="likes">
          <!-- カスタムデータ属性を設定 -->
          <i class="fa-solid fa-carrot like-toggle" data-recipe-id="{{ $recipe_detail->id }}">たべた！</i>
          <!-- いいねカウンター表示 -->
          <span class="like-counter">{{ ($recipe_detail->likes_count == 0) ? "" : $recipe_detail->likes_count }}</span>
        </span>
      </div>

      <!-- いいねの既に押された投稿 -->
      @else
      <div>
        <span class="likes">
          <i class="fa-solid fa-carrot like-toggle liked" data-recipe-id="{{ $recipe_detail->id }}">たべた！</i>
          <span class="like-counter">{{ ($recipe_detail->likes_count == 0) ? "" : $recipe_detail->likes_count }}</span>
        </span>
      </div>
      @endif


      <!-- ブックマーク機能 -->
      @if (!$recipe_detail->isMarkedBy(Auth::user()))
      <div>
        <span class="markes">
          <i class="fa-solid fa-bookmark bookmark-toggle" data-recipes-id="{{ $recipe_detail->id }}"></i>
          <span class="mark-counter">{{ ($recipe_detail->favorites_count == 0) ? "" : $recipe_detail->favorites_count }}</span>
        </span>
      </div>
      @else
      <div>
        <span class="markes">
          <i class="fa-solid fa-bookmark bookmark-toggle marked" data-recipes-id="{{ $recipe_detail->id }}"></i>
          <span class="mark-counter">{{ ($recipe_detail->favorites_count == 0) ? "" : $recipe_detail->favorites_count }}</span>
        </span>
      </div>
      @endif


      <div class="py-3">
        <div class="border-bottom border-secondary">
          調理時間：{{ $recipe_detail->cooking_time }}分
        </div>
        <div class="border-bottom border-secondary">
          対象年齢：{{ $recipe_detail->ages }}
        </div>
      </div>

      <div class="border-bottom border-secondary">
        <h5> 材料({{ $recipe_detail->howmany }}名分)</h5>
      </div>

      @foreach($recipe_detail->foodstuffs as $foodstuff)
      <div class="row">
        <div class="border-bottom border-secondary">
          <div>
            {{ $foodstuff->food }}
          </div>
          <div class="d-flex justify-content-end">
            {{ $foodstuff->amount }}
          </div>
        </div>
      </div>
      @endforeach

    </div>


    <div class="container">
      <div class="row">
        <div>
          <h5>作り方</h5>
        </div>
        @foreach($recipe_detail->contents as $key=>$content)
        <div class="card border-0" style="width: 15rem;">
          <div>
            {{ $key+1 }}
          </div>
          <div class="card-img-top">
            <img src="{{ asset($content->recipe_image) }}" width="100%">
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
</div>




@endsection