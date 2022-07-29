<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
use App\User;
use App\Recipe;
use App\Content;
use App\Foodstuff;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // 全レシピの取得
    // public function getArticleAll()
    // {
    //     $recipes = Recipe::all();

    //     return view(
    //         'recipes/articles',
    //         ['recipe' => $recipes]
    //     );
    // }

    // レシピ作成画面へ遷移
    public function showCreateForm()
    {
        return view('recipes/create');
    }


    // レシピの登録
    public function createRecipe(Request $request)
    {
        $recipe = new Recipe();
        $content = new Content();
        $foodstuff = new Foodstuff();

        // 現在ログインしているユーザーをrecipesテーブルに登録
        Auth::user()->recipes()->save($recipe);

        // recipesテーブルに各値を登録
        $recipe->title = $request->title;
        $recipe->howmany = $request->howmany;
        $recipe->product_image = $request->product_image;
        $recipe->cooking_time = $request->cooking_time;
        $recipe->ages = $request->ages;

        $recipe->save();


        // foodstuffsテーブルに登録

        $food = $request->foodstuff;



    }




}
