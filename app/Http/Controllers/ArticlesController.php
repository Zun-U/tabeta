<?php

namespace App\Http\Controllers;

// 各モデルのuse宣言
// use App\User;
use App\Recipe;


use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    // レシピの一覧表示
    public function getArticleAll(Request $request)
    {


        // 検索結果の受け取り
        $keyword = $request->input('keyword');

        // 
        $query = Recipe::query();


        // 作成日順で５件取得
        $recipes = Recipe::withCount('likes')->withCount('favorites')->orderBy("id", "desc")->paginate(5);



            if($keyword){
                $query->where('title', 'like', "%{$keyword}%");

                $recipes = $query->paginate(5);
            }





        return view(
            'recipes/articles',
            compact('recipes','keyword')
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
