<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
use App\User;
use App\Recipe;
use App\Content;
use App\Foodstuff;

// Storageクラスの使用（画像保存の為）
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RecipeController extends Controller
{


    // レシピ作成画面へ遷移
    public function showCreateForm()
    {
        return view('recipes/create');
    }


    // レシピの登録
    public function createRecipe(Request $request)
    {
        $recipe = new Recipe();


        // TOPレシピ画像ファイルの取得
        $recipe_image = $request->file('product_image');

        // 画像ファイルがあれば
        if ($recipe_image) {
            $image_path = Storage::disk("public")->putFile('profile', $recipe_image);
            $imagePath = "/storage/" . $image_path;
            $recipe->product_image = $imagePath;
        }
        // 画像ファイルがなければ
        else {
            $image_path = null;
        }

        // recipesテーブルに各値を登録
        $recipe->title = $request->title;
        $recipe->subtitle = $request->subtitle;
        $recipe->howmany = $request->howmany;
        $recipe->cooking_time = $request->cooking_time;
        $recipe->ages = $request->ages;

        // 現在ログインしているユーザーをrecipesテーブルに登録
        Auth::user()->recipes()->save($recipe);




        // foodstuffsテーブルに登録
        // 2つの異なるname属性に入力されたフォームの値それぞれを全取得
        $ingredients = $request->input('foodstuff');

        // name属性に指定した配列のkeyのみを取得
        foreach ($ingredients['food'] as $key => $value) {
            $foodstuff = new Foodstuff();
            $foodstuff->food = $ingredients['food'][$key];
            $foodstuff->amount = $ingredients['amount'][$key];
            $recipe->foodstuffs()->save($foodstuff);
        }





        // contentsテーブルに登録
        // テキスト入力と画像投稿欄を別々に取得
        $explanations = $request->input('content');
        $upload_image = $request->file('upload_image');



        // 各入力欄の共通項である「key」を取得（連番を取得）
        foreach ($explanations['text'] as $key => $value) {

            $content = new Content();

            // 画像ファイルの有無判定（keyに紐づいた入力値を判定）
            if (isset($upload_image['cooking_image'][$key])) {
                $uploard_path = Storage::disk("public")->putFile('profile', $upload_image['cooking_image'][$key]);
                $uploadPath = "/storage/" . $uploard_path;
                $content->recipe_image = $uploadPath;
            } else {
                // ファイルがなければNULLを返す
                $uploard_path = NULL;
            }




            $content->content = $explanations['text'][$key];
            $recipe->contents()->save($content);
        }


        // 直前に登録したテーブル情報の取得(複数小テーブル含む)
        // $recipes = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

        // foreach($recipes->contents as $content){
        //     dd($content->id);
        //     exit;
        // }


        return redirect()->route(
            'recipe.preview',
            [
                'recipe' => $recipe
            ]
        );
    }


    public function showPreview(Recipe $recipe)
    {



        $recipes = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

        // dd($recipes);
        // exit;

        return view('recipes/preview', compact('recipes'));
    }
}
