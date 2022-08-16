@extends('layout')

@section('content')

<a>記事を投稿しました。</a>


<div>
<div class="col">
  {{ $recipes->title }}:
  <img src="{{ $recipes->product_image }}" width="200px" height="200px" >
</div>
<div class="col">
  {{ $recipes->subtitle }}
</div>
<div class="col">
  調理時間：{{ $recipes->cooking_time }}分
</div>
<div class="col">
{{ $recipes->howmany }}名分
</div>
<div class="col">
  対象年齢：{{ $recipes->ages }}
</div>

@foreach($recipes->foodstuffs as $foodstuff)
<div class="col">
  材料：{{$foodstuff->food }}:{{ $foodstuff->amount }}
</div>
@endforeach

@foreach($recipes->contents as $content)
<div class="col">
作り方：{{ $content->content }}
<img src="{{ $content->recipe_image }}" width="200px" height="200px">
</div>
@endforeach
</div>



@endsection