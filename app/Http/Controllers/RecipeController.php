<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
use App\Recipe;
use App\Content;
use App\Foodstuff;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // 全レシピの取得
    public function getArticleAll()
    {
        $recipes = Recipe::all();

        return view(
            'recipes/articles',
            ['recipe' => $recipes]
        );
    }

    // レシピ作成画面へ遷移
    public function showCreateForm()
    {
        return view('recipes/create');
    }

    // レシピの登録
    public function createRecipe(Request $request)
    {
        $recipe = new Recipe();

        // 現在ログインしているユーザーとrecipeテーブル
        Auth::user()->recipes()->save($recipe);
    }
}
