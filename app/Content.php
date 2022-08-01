<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    // タイムスタンプを無効にする。
    public $timestamps = false;

    // 多対1のリレーション
    public function recipe()
    {
        return $this->belongsTo('App/recipe');
    }
}
