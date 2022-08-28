@extends('layout')

@section('content')



<form action="{{ route('recipe.update', $recipe_edit)}}" method="POST" id="createrecipe" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div class="container">
        <div class="row pt-5">

            <div class="col-6 mt-4 imagearea">
                <label for="image-upload">
                    <div class="d-flex">
                        <i class="fa-solid fa-camera add-camera pb-1 px-3"></i>
                        <div class="pt-2 photo-explanation">
                            <span>写真</span>
                        </div>
                    </div>
                    <div class="image-hover imagefile">
                        <img id="img_preview" class="img-fluid" src="{{ $recipe_edit->product_image }}">
                    </div>
                    <input type="hidden" name="_method" id="image-upload" class="invisible" value="patch {{ $recipe_edit->product_image }}">
                </label>
            </div>
            <div class="col-6 mt-5">
                <div class="col mb-2">
                    <label for="title" class="form-label">レシピ名</label>

                    <input type="hidden" class="form-control" name="_method" id="title" value="patch {{ $recipe_edit->title }}" />
                </div>
                <div class="col pt2">
                    <label for="subtitle" class="form-label pt-3">サブタイトル</label>
                    <input type="hidden" class="form-control" name="_method" id="subtitle" value="patch {{ $recipe_edit->subtitle }}" />
                </div>

                <div class="row pt-4">
                    <div class="col mb-2">
                        <label for="cooking_time" class="form-label pt-2">調理時間</label>
                        <select class="form-select" aria-label="cooking_time" name="cooking_time" id="cooking_time" value="{{ $recipe_edit->cooking_time }}"></select>
                    </div>
                    <div class="col mb-2">
                        <label for="howmany" class="form-label pt-2">何人分</label>
                        <input type="hidden" class="form-control" name="_method" id="howmany" value="patch {{ $recipe_edit->howmany }}" />
                    </div>
                </div>

                <div class="pt-3">
                    <label for="ages" class="form-label">対象年齢</label>
                    <div class="form-check-inline me-5">
                        <input type="radio" class="form-check-label" value="全年齢" name="ages" id="ages">指定なし
                        <input type="radio" class="form-check-label" value="5、6ヶ月" name="ages" id="ages">5、6ヶ月
                        <input type="radio" class="form-check-label" value="7、8ヶ月" name="ages" id="ages">7、8ヶ月
                        <input type="radio" class="form-check-label" value="9～10ヶ月" name="ages" id="ages">9~10ヶ月
                        <input type="radio" class="form-check-label" value="1～1歳半" name="ages" id="ages">1～1歳半
                        <input type="radio" class="form-check-label" value="1歳半～" name="ages" id="ages">1歳半～
                        <input type="radio" class="form-check-label" value="2歳" name="ages" id="ages">2歳
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="center-section">
            <div class="row pt-5">
                <div class="col-sm mt-4">
                    <h5>材料</h5>
                </div>
            </div>

            <!-- 食材入力部分 -->
            @foreach($recipe_edit->foodstuffs as $foodstuff)
            <div class="row mt-2" id="input-area">
                <div class="col-3">
                    <input type="hidden" class="form-control check-food" name="_method foodstuff[food][]" placeholder="材料・調味料" value="patch {{ $foodstuff->food }}">
                </div>
                <div class="col-3">
                    <input type="hidden" class="form-control check-amount" name="_method foodstuff[amount][]" placeholder="分量" value="patch {{ $foodstuff->amount }}">
                </div>
                <!-- フォーム欄1段目は削除アイコン非表示 -->
                <div class="col-1">
                    <button type="button" onclick="removeForm(this)" id="btn-remove" class="btn btn-outline-primary count-foodstuff invisible" name="btn-remove"><img src="{{ asset('images/trashicon.svg')}}" class="trashicon"></button>
                </div>
            </div>
            @endforeach



            <!-- JavaScriptでフォーム入力欄追加 -->
            <div id="clone-area"></div>


            <div class="mt-3 pe-5 add-btn">
                <button type="button" id="btn-add" class="btn btn-primary rounded-3">材料の追加</button>
            </div>


            <div class="col-sm mt-5 mb-2">
                <h5>作り方</h5>
            </div>
            @foreach($recipe_edit->contents as $key=>$content)
            <div class="row mt-4 align-items-center d-flex" id="procedure-area">
                <div class="col-6 me-3 howto">
                    <div class="align-self-start">
                        <span class="howto-number[0] num-increment">{{ $key+1 }}</span>
                    </div>
                    <input type="text" class="form-control check_text" name="content[text][]" id="contents" value="{{ $content->content }}">
                </div>
                <div class="col-1 mb-4 pb-5">
                    <label class="howto">
                        <div class="howto-put">
                            <img id="img_preview" class="img-fluid rounded-3 shadow w-50" src="{{ $content->recipe_image }}">
                        </div>
                        <input type="file" name="upload_image[cooking_image][]" class="howto-image invisible" value="{{ $content->recipe_image }}">
                    </label>
                </div>
                <div class="col-1 offset-md-2">
                    <button type="button" onclick="removeProcedure(this)" id="remove-procedure" class="btn btn-outline-primary count-content invisible" name="btn-remove"><img src="{{ asset('images/trashicon.svg')}}" class="trashicon"></button>
                </div>
            </div>
            @endforeach


            <!-- 手順入力欄をJSで複製、以下にdivタグに追加 -->
            <div id="clone-procedure"></div>


            <div class="mt-3 pe-5">
                <button type="button" id="add-procedure" class="btn btn-primary">作り方の追加</button>
            </div>

            <div class="text-right mt-5">
                <button type="submit" id="create-recipe" class="btn btn-primary">レシピの投稿</button>
            </div>
        </div>
    </div>
</form>





@endsection