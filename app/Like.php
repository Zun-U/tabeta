<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    // タイムスタンプを無効にする。
    public $timestamps = false;

    // 多対1のリレーション
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function recipes()
    {
        return $this->belongsTo('App\Recipe');
    }

}
