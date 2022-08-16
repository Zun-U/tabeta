<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
use App\User;
use App\Recipe;
use App\Content;
use App\Foodstuff;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    // 全レシピの取得
    public function getArticleAll()
    {
        $recipes = Recipe::all();

        return view(
            'recipes/articles',
            ['recipes' => $recipes]
        );
    }

    public function getArticleDetail(Recipe $recipe)
    {

        $recipe_detail = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

        return view(
            'recipes/recipe',
            compact('recipe_detail')
        );
    }
}
