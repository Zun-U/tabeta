@extends('layout')

@section('content')

<!-- フラッシュメッセージ -->
@if (session('success_message'))
<div class="flash_message bg-success text-center py-3 my-0">
  {{ session('success_message') }}
</div>
@endif



<div class="container">
  <div class="row gx-5">
    <div class="col mt-5">
      <img src="{{ $recipes->product_image }}" class="img-fluid px-2">
    </div>
    <div class="col pt-5 text-area">
      <div>
        <h2 class="py-1">{{ $recipes->title }}</h2>
      </div>
      <div>
        <h4 class="py-2">{{ $recipes->subtitle }}</h4>
      </div>


      <div class="d-flex justify-content-end pt-3">
        <div class="border-bottom">
          <span>
            <i class="fa-regular fa-clock px-2"></i>{{ $recipes->cooking_time }}分
          </span>
        </div>
        <div class="border-bottom">
          <span>
            <i class="fa-solid fa-child px-2 ms-3"></i>{{ $recipes->ages }}
          </span>
        </div>
      </div>

      <div class="row py-2 mt-4">
        <div class="border-bottom border-secondary">
          <h5> 材料({{ $recipes->howmany }}名分)</h5>
        </div>
      </div>

      @foreach($recipes->foodstuffs as $foodstuff)
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
        @foreach($recipes->contents as $key=>$content)
        <div class="card border-0" style="width: 15rem;">
          <div class="serial-number">
            {{ $key+1 }}
          </div>
          <div class="card-img-top mt-3 border rounded-3">
            <img src="{{ $content->recipe_image }}" width="100%">
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