@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <form action="{{ route('recipes.create') }}" method="POST" id="createrecipe" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="file" name="product_image" class="form-control">
                </div>

                <div>
                    <label for="title" class="form-label">レシピ名</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                </div>
                <div>
                    <label for="howmany" class="form-label">何人分</label>
                    <input type="text" class="form-control" name="howmany" id="howmany" value="{{ old('howmany') }}" />
                </div>

                <div>
                    <label for="cooking_time" class="form-label">調理時間</label>
                    <select class="form-select" aria-label="cooking_time" name="cooking_time" id="cooking_time"></select>
                </div>
                <div>
                    <label for="ages" class="form-label">対象年齢</label>
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-label" value="全年齢" name="ages" id="ages">指定なし
                        <input type="radio" class="form-check-label" value="5、6ヶ月" name="ages" id="ages">5、6ヶ月
                        <input type="radio" class="form-check-label" value="7、8ヶ月" name="ages" id="ages">7、8ヶ月
                        <input type="radio" class="form-check-label" value="9～10ヶ月" name="ages" id="ages">9~10ヶ月
                        <input type="radio" class="form-check-label" value="1～1歳半" name="ages" id="ages">1～1歳半
                        <input type="radio" class="form-check-label" value="1歳半～" name="ages" id="ages">1歳半～
                        <input type="radio" class="form-check-label" value="2歳" name="ages" id="ages">2歳
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">材料・調味料</div>
                    <div class="col-sm">分量</div>
                    <div class="col-sm"></div>
                </div>

                <!-- 食材入力部分 -->
                <div class="row" id="input-area">
                    <div class="col-sm">
                        <!-- name属性に[]を入れて、配列として値を渡す。 -->
                        <input type="text" class="form-control" name="foodstuff[food][]">
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control" name="foodstuff[amount][]">
                    </div>
                    <!-- フォーム欄1段目は削除アイコン非表示 -->
                    <div class="col-sm">
                        <button type="button" onclick="removeForm(this)" id="btn-remove" class="btn btn-outline-primary invisible" name="btn-remove"><img src="{{ asset('images/trashicon.svg')}}" class="trashicon"></button>
                    </div>
                </div>



                <!-- JavaScriptでフォーム入力欄追加 -->
                <div id="clone-area"></div>

                <div>
                    <button type="button" id="btn-add" class="btn btn-outline-primary">追加{!! file_get_contents(public_path('images/addicon.svg')) !!}</button>
                </div>


                <div>
                    <label for="content" class="form-label">作り方</label>
                </div>
                <div class="row" id="procedure-area">
                    <div class="col-sm">
                        <input type="text" class="form-control" name="content[text][]" id="contents" value="{{ old('contents') }}" />
                    </div>
                    <div class="col-sm">
                        <button type="button" onclick="removeProcedure(this)" id="remove-procedure" class="btn btn-outline-primary invisible" name="btn-remove"><img src="{{ asset('images/trashicon.svg')}}" class="trashicon"></button>
                    </div>
                    <div>
                        <input type="file" name="content[upload_image]" class="form-control">
                    </div>
                </div>

                <!-- 手順入力欄をJSで複製、以下にdivタグに追加 -->
                <div id="clone-procedure"></div>

                <div>
                    <button type="button" id="add-procedure" class="btn btn-outline-primary">追加{!! file_get_contents(public_path('images/addicon.svg')) !!}</button>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">プレビューを見る</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection