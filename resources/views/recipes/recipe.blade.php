@extends('layout')

@section('content')


<div>
  <div class="col">
    {{ $recipe_detail->title }}:
    <img src="{{ $recipe_detail->product_image }}" width="200px" height="200px">
  </div>
  <div class="col">
    {{ $recipe_detail->subtitle }}
  </div>
  <div class="col">
    調理時間：{{ $recipe_detail->cooking_time }}分
  </div>
  <div class="col">
    {{ $recipe_detail->howmany }}名分
  </div>
  <div class="col">
    対象年齢：{{ $recipe_detail->ages }}
  </div>

  <div> 材料</div>
  @foreach($recipe_detail->foodstuffs as $foodstuff)
  <div class="col">
    {{$foodstuff->food }}:{{ $foodstuff->amount }}
  </div>
  @endforeach

  <div>作り方</div>
  @foreach($recipe_detail->contents as $content)
  <div class="col">
    {{ $content->content }}
    <img src="{{ asset($content->recipe_image) }}" width="200px" height="200px">
  </div>
  @endforeach


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

</div>




@endsection