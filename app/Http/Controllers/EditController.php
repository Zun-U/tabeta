<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
use App\Content;
use App\Foodstuff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class EditController extends Controller
{

    // レシピ編集画面へ遷移
    public function showEditForm(Recipe $recipe)
    {

        $recipe_edit = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

        // dd($recipe_edit);
        // exit;

        // 直前のページのレシピ情報を渡す
        return view('recipes.edit', compact('recipe_edit'));
    }


    // レシピの編集
    public function editRecipe(Request $request, Recipe $recipe)
    {


        // $idsf = Recipe::find($recipe->id);


        // $recipe_update = Recipe::with(['foodstuffs', 'contents'])->find($recipe->id);

        // // $recipe = new Recipe();

        // $foodstuff = $recipe->foodstuffs;

        // $content = $recipe->contents;


        // dd($content);
        // exit;


        // TOPレシピ画像ファイルの取得
        $recipe_image = $request->file('product_image');

        // dd($recipe_image);
        // exit;

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

        $recipe->save();




        // foodstuffsテーブルに登録
        // 2つの異なるname属性に入力されたフォームの値それぞれを全取得
        $ingredients = $request->input('foodstuff');

        // name属性に指定した配列のkeyのみを取得
        foreach ($ingredients['food'] as $key => $value) {
            $foodstuff = new Foodstuff();

            $foodstuff->food->delete();
            $foodstuff->food = $ingredients['food'][$key];

            $foodstuff->amount->delete();
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

        return view('recipes/preview', compact('recipes'));
    }
}
