<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
use App\Recipe;


use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    // レシピの一覧表示
    public function getArticleAll()
    {

        // 作成日順で
        $recipes = Recipe::withCount('likes')->withCount('favorites')->orderBy("id", "desc")->where(function ($query) {

            // 検索機能
            if ($search = request('search')) {
                $query->where('title', 'like', "%{$search}%");
            }

            // 5件数ごとにページネーション
        })->paginate(5);


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
