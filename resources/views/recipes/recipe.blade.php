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
</div>




@endsection