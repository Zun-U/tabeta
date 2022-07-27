@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <form action="{{ route('recipes.create') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">レシピ名</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                </div>
                <label for="howmany">何人分</label>
                <input type="text" class="form-control" name="howmany" id="howmany" value="{{ old('howmany') }}" />
                <div>

                </div>
                <div>
                    <label for="cooking_time">調理時間</label>
                    <select class="form-select" aria-label="cooking_time" name="cooking_time" id="cooking_time"></select>
                </div>
                <div>
                    <label for="ages">対象年齢</label>
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
                        <input type="text" class="form-control" name="foodstuff">
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control" name="amount">
                    </div>
                    <!-- 削除アイコンは非表示 -->
                    <div class="col-sm">
                        <button type="button" id="btn-remove" class="btn btn-outline-primary invisible"><img src="{{ asset('images/trashicon.svg')}}" class="trashicon"></button>
                    </div>
                </div>


                <!-- JavaScriptでフォーム入力欄追加 -->
                <div id="clone-area"></div>


                <div>
                    <button type="button" id="btn-add" class="btn btn-outline-primary">{!! file_get_contents(public_path('images/addicon.svg')) !!}追加</button>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection