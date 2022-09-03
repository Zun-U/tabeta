<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // 各テーブルリレーション
    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }

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

    // ブックマークの多対多の関係
    public function bookmark_articles()
    {

        return $this->belongsToMany('App\Recipe', 'favorites', 'user_id', 'recipe_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function followers()
    {
        return $this->hasMany('App\Follower');
    }




    // //いいねされているかを判定（boolで真偽値を判定）
    // public function isLikedBy($user): bool
    // {
    //     return Like::where('user_id', $user->id)->where('recipe_id', $this->id)->first() !== null;
    // }


    // //ブックーマーク存在判定
    // public function isMarkedBy($user): bool
    // {
    //     return Favorite::where('user_id', $user->id)->where('recipe_id', $this->id)->first() !== null;
    // }
}
