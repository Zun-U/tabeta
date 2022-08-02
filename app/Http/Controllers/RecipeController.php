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




        // テスト------------------------------

        // 2つの異なるname属性に入力されたフォームの値それぞれを全取得
        $req = $request->input('foodstuff');

        // dump($req);
        // dump($req['amount']);

        // foreachで回す
        foreach ($req as $key => $value) {

            dump($value);
            // foreach($value as $key2 => $value2){
            //     dump($value2);
            } 

        //     foreach($value as $vas){
        //         dump($vas[$key]);



        // }

        // -------------------------------------





        //
        // dd($request->only('foodstuff.*','amount.*'));
        // $req = $request->only('foodstuff.*','amount.*');
        // $foods = $request->input('foodstuff.*');
        // $amounts = $request->input('amount.*');



        // foreach ($foods as $food) {

        //     dump($food);
        // }


        // foreach ($amounts as $amount) {

        //     dump($amount);
        // }





        exit;



        $recipe = new Recipe();
        // $foodstuff = new Foodstuff();


        // recipesテーブルに各値を登録
        $recipe->title = $request->title;
        $recipe->howmany = $request->howmany;
        $recipe->product_image = $request->product_image;
        $recipe->cooking_time = $request->cooking_time;
        $recipe->ages = $request->ages;

        // 現在ログインしているユーザーをrecipesテーブルに登録
        Auth::user()->recipes()->save($recipe);



        // foodstuffsテーブルに登録
        $foods = $request->input('foodstuff.*');
        $amounts = $request->input('amount.*');

        foreach ($foods as $food) {
            $foodstuff = new Foodstuff();
            $foodstuff->food = $food;
            // foreach ($amounts as $amount) {
            //     $foodstuff = new Foodstuff();
            // $foodstuff->amount = $amounts;

            // }
            $recipe->foodstuffs()->save($foodstuff);
        }

        // foreach ($amounts as $amount) {
        //     $foodstuff = new Foodstuff();
        //     $foodstuff->amount = $amount;
        // }


        // $recipe->foodstuffs()->save($foodstuff);




        // contentsテーブルに登録
        // $explanations = $request->all();
        // foreach ($explanations as $explanation) {
        //     $content = new Content();
        //     $content->content = $explanation->content;
        //     $content->recipe_image = $explanation->recipe_image;
        //     $recipe->contents()->save($content);
        // }


        return view('recipes/preview');
    }
}
