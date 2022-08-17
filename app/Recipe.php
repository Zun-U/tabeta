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

    public function contents(){
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


    //いいねされているかを判定
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('recipe_id', $this->id)->first() !==null;
    }

    // ブックマーク判定
    public function isMarkedBy($user): bool {
        return Favorite::where('user_id', $user->id)->where('recipe_id', $this->id)->first() !==null;
    }

}
