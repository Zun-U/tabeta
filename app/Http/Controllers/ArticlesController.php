<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
use App\User;
use App\Recipe;
use App\Like;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    // レシピの一覧表示
    public function getArticleAll()
    {

        // 作成日順で10件数ごとに取得
        $recipes = Recipe::withCount('likes')->orderBy("id","desc")->paginate(10);

        return view(
            'recipes/articles',
            ['recipes' => $recipes]
        );
    }

    // レシピ詳細画面への遷移
    public function getArticleDetail(Recipe $recipe)
    {

        $recipe_detail = Recipe::withCount('likes')->with(['foodstuffs', 'contents'])->find($recipe->id);

        return view(
            'recipes/recipe',
            compact('recipe_detail')
        );
    }
}
