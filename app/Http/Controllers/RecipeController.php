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
    public function createRecipe(Recipe $recipe, Request $request)
    {
        $recipe = new Recipe();



        // test
        // ------------------------------
        $explanations = $request->input('content');

        dump($explanations);

        foreach ($explanations['text'] as $key => $value) {

            dump($explanations['text'][$key]);
            dump($explanations['image'][$key]);
        }
        exit;
        // ------------------------------


        // recipesテーブルに各値を登録
        $recipe->title = $request->title;
        $recipe->howmany = $request->howmany;
        $recipe->product_image = $request->product_image;
        $recipe->cooking_time = $request->cooking_time;
        $recipe->ages = $request->ages;

        // 現在ログインしているユーザーをrecipesテーブルに登録
        Auth::user()->recipes()->save($recipe);


        // foodstuffsテーブルに登録
        // 2つの異なるname属性に入力されたフォームの値それぞれを全取得
        $ingredients = $request->input('foodstuff');


        foreach ($ingredients['food'] as $key => $value) {
            $foodstuff = new Foodstuff();
            $foodstuff->food = $ingredients['food'][$key];
            $foodstuff->amount = $ingredients['amount'][$key];
            $recipe->foodstuffs()->save($foodstuff);
        }





        // contentsテーブルに登録
        $explanations = $request->input('content');


        foreach ($explanations['text'] as $key => $value) {
            $content = new Content();
            $content->content = $explanations['text'][$key];
            $content->recipe_image = $explanations['image'][$key];
            $recipe->contents()->save($content);
        }


        return view('recipes/preview');
    }
}
