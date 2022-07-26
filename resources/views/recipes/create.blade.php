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
                <div>
                    <label for="cooking_time">調理時間</label>
                    <select class="form-select" aria-label="cooking_time" name="cooking_time" id="cooking_time"></select>
                </div>
                <div>
                    <label for="ages">対象年齢</label>
                    <select class="form-select" aria-label="ages" name="ages" id="ages">
                        <option value="全年齢">指定なし</option>
                        <option value="5、6ヶ月">5、6ヶ月</option>
                        <option value="7、8ヶ月">7、8ヶ月</option>
                        <option value="9～10ヶ月">9~10ヶ月</option>
                        <option value="1～1歳半">1～1歳半</option>
                        <option value="1歳半～">1歳半～</option>
                        <option value="2歳">2歳</option>
                    </select>
                </div>

                <!-- 食材入力部分 -->



                <div class="text-right">
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection