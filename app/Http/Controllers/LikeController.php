<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Like;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        // ログインしているユーザー
        $user_id = Auth::user()->id;

        //POST送信されてきた、いいねされたレシピid
        $recipe_id = $request->recipe_id;

        // いいねの存在検証
        $already_liked = Like::where('user_id', $user_id)->where('recipe_id', $recipe_id)->first();


        // いいねしてなかったら
        if (!$already_liked) {

            $like = new Like;

            $like->recipe_id = $recipe_id;

            $like->user_id = $user_id;

            $like->save();

            //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        } else {
            Like::where('recipe_id', $recipe_id)->where('user_id', $user_id)->delete();
        }


        // この投稿の最新の総いいね数を取得。withCountにリレーションしているモデルを引数として渡している。
        $recipe_likes_count = Recipe::withCount('likes')->findOrFail($recipe_id)->likes_count;

        $param = [
            'recipe_likes_count' => $recipe_likes_count,
        ];

        // JSONデータをjQueryに返す
        return response()->json($param);
    }
}
