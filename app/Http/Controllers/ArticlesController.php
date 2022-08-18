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
        $recipes = Recipe::withCount('likes')->withCount('favorites')->orderBy("id", "desc")->paginate(5);
        // dd(Recipe::withCount('likes')->withCount('favorites'));
        // exit;

        // dd($recipes);
        // exit;

        return view(
            'recipes/articles',
            compact('recipes')
        );
    }

    // レシピ詳細画面への遷移
    public function getArticleDetail(Recipe $recipe)
    {

        $recipe_detail = Recipe::withCount('likes')->withCount('favorites')->with(['foodstuffs', 'contents'])->find($recipe->id);

        return view(
            'recipes/recipe',
            compact('recipe_detail')
        );
    }
}
