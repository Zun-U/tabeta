<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    // 各テーブルリレーション
    public function foodstuffs()
    {
        return $this->hasMany('App\Foodstuff');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    // 多対1のリレーション
    public function users()
    {
        return $this->belongsTo('App/User');
    }


    //いいねされているかを判定（boolで真偽値を判定）
    public function isLikedBy($user): bool
    {
        //  !== null　→　nullならnull以外(false)で返す。
        // Likesテーブルのuser_idとログインユーザーidが一致するもの、且つ、Likesテーブルのrecipe_idと現在見ているレシピ記事のrecipe_idを検索、最初に返ってきたものを呼び出し元（view）に返却。
        // いいねされていたら「true」、されていなかったら「false」を返す。
        return Like::where('user_id', $user->id)->where('recipe_id', $this->id)->first() !== null;
    }


        //ブックーマーク存在判定
        public function isMarkedBy($user): bool
        {
            return Favorite::where('user_id', $user->id)->where('recipe_id', $this->id)->first() !== null;
        }
}
