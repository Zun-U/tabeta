<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    // タイムスタンプを無効にする。
    public $timestamps = false;

    // 多対1のリレーション
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function recipe()
    {
        return $this->belongsTo('App/Recipe');
    }

}
