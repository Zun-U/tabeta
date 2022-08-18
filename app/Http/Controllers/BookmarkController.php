<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Favorite;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    public function bookmark(Request $request)
    {
        // ログインしているユーザー
        $user_id = Auth::user()->id;

        //POST送信されてきた、いいねされたレシピid
        $recipe_id = $request->recipe_id;

        // いいねの存在検証
        $already_marked = Favorite::where('user_id', $user_id)->where('recipe_id', $recipe_id)->first();

        // いいねしてなかったら
        if (!$already_marked) {

            $favorite = new Favorite;

            $favorite->recipe_id = $recipe_id;

            $favorite->user_id = $user_id;

            $favorite->save();

        } else {
            Favorite::where('recipe_id', $recipe_id)->where('user_id', $user_id)->delete();
        }



        // この投稿の最新の総いいね数を取得。withCountにモデルのlikesメソッドを引数として渡している。
        // 「favorites_count」は withCountメソッドとセットの関係
        $recipe_markes_count = Recipe::withCount('favorites')->findOrFail($recipe_id)->favorites_count;

        $param = [
            'recipe_markes_count' => $recipe_markes_count,
        ];


        // JSONデータをjQueryに返す
        return response()->json($param);
    }

}
