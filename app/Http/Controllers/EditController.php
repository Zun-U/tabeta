<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
use App\Content;
use App\Foodstuff;
use App\Favorite;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// バリデーション
use App\Http\Requests\EditRecipe;

use Illuminate\Http\Request;

class EditController extends Controller
{

    // レシピ編集画面へ遷移
    public function showEditForm(Recipe $recipe)
    {

        $recipe_edit = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

        // 直前のページのレシピ情報を渡す
        return view('recipes.edit', compact('recipe_edit'));
    }


    // レシピの編集
    public function editRecipe(EditRecipe $request, Recipe $recipe)
    {

        // TOPレシピ画像ファイルの取得
        $recipe_image = $request->file('product_image');


        // 画像ファイルがあれば
        if ($recipe_image) {
            $image_path = Storage::disk("public")->putFile('profile', $recipe_image);
            $imagePath = "/storage/" . $image_path;
            $recipe->product_image = $imagePath;
        }
        // // 画像ファイルがなければ
        // else {
        //     $image_path = null;
        // }

        // recipesテーブルに各値を登録
        $recipe->title = $request->title;
        $recipe->subtitle = $request->subtitle;
        $recipe->howmany = $request->howmany;
        $recipe->cooking_time = $request->cooking_time;
        $recipe->ages = $request->ages;

        $recipe->save();


        // 一旦中身を全削除する
        $foodstuff = new Foodstuff();
        $foodstuff->where('recipe_id', $recipe->id)->delete();


        // 新たに、foodstuffsテーブルに登録
        // 2つの異なるname属性に入力されたフォームの値それぞれを全取得
        $ingredients = $request->input('foodstuff');

        // name属性に指定した配列のkeyのみを取得
        foreach ($ingredients['food'] as $key => $value) {
            $foodstuff = new Foodstuff();

            $foodstuff->food = $ingredients['food'][$key];

            $foodstuff->amount = $ingredients['amount'][$key];
            $recipe->foodstuffs()->save($foodstuff);
        }


        // 一旦中身を全削除する
        $content = new Content();
        $content->where('recipe_id', $recipe->id)->delete();

        // 新たに、contentsテーブルに登録
        // テキスト入力と画像投稿欄を別々に取得
        $explanations = $request->input('content');
        $upload_image = $request->file('upload_image');

        // すでに登録済みの画像パスを取得
        $upload_image_path = $request->input('upload_image_path');



        // 各入力欄の共通項である「key」を取得（連番を取得）
        foreach ($explanations['text'] as $key => $value) {

            $content = new Content();

            // 画像ファイルの有無判定（keyに紐づいた入力値を判定）
            if (isset($upload_image['cooking_image'][$key])) {
                $uploard_path = Storage::disk("public")->putFile('profile', $upload_image['cooking_image'][$key]);
                $uploadPath = "/storage/" . $uploard_path;
                $content->recipe_image = $uploadPath;
            } 
        else {
                // ファイルがなければそのままの画像パスを返す
                $content->recipe_image = $upload_image_path['image_path'][$key];
 
            }

            $content->content = $explanations['text'][$key];
            $recipe->contents()->save($content);
        }




        return redirect()->route(
            'recipe.preview',
            [
                'recipe' => $recipe
            ]
        );
    }


    // public function showPreview(Recipe $recipe)
    // {

    //     $recipes = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

    //     session()->flash('success_message', 'レシピを編集しました！');

    //     return view('recipes/preview', compact('recipes'));
    // }



    // レシピ削除
    public function destroyRecipe(Recipe $recipe)
    {

        $foodstuff = new Foodstuff();
        $foodstuff->where('recipe_id', $recipe->id)->delete();

        $content = new Content();
        $content->where('recipe_id', $recipe->id)->delete();

        $favorite = new Favorite();
        $favorite->where('recipe_id', $recipe->id)->delete();

        $like = new Like();
        $like->where('recipe_id', $recipe->id)->delete();

        $recipe->where('id', $recipe->id)->delete();

        return redirect(route('articles.index'));
    }
}
